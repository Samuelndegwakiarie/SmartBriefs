<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BriefController extends Controller
{
    /**
     * Display a listing of the user's briefs.
     */
    public function index()
    {
        $briefs = Brief::where('user_id', Auth::id())->latest()->get();
        return view('briefs.index', compact('briefs'));
    }

    /**
     * Show the form for creating a new brief.
     */
    public function create()
    {
        return view('briefs.create');
    }

    /**
     * Store a newly created brief in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|max:2048', // 2MB max
        ]);

        $path = null;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Brief::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'attachment_path' => $path,
        ]);

        return redirect()->route('briefs.index')->with('success', 'Brief created successfully.');
    }

    /**
     * Display the specified brief.
     */
    public function show(Brief $brief)
    {
        $this->authorizeBrief($brief);

        return view('briefs.show', compact('brief'));
    }

    /**
     * Show the form for editing the specified brief.
     */
    public function edit(Brief $brief)
    {
        $this->authorizeBrief($brief);

        return view('briefs.edit', compact('brief'));
    }

    /**
     * Update the specified brief in storage.
     */
    public function update(Request $request, Brief $brief)
    {
        $this->authorizeBrief($brief);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            // Delete old file if exists
            if ($brief->attachment_path) {
                Storage::disk('public')->delete($brief->attachment_path);
            }

            $brief->attachment_path = $request->file('attachment')->store('attachments', 'public');
        }

        $brief->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'attachment_path' => $brief->attachment_path,
        ]);

        return redirect()->route('briefs.index')->with('success', 'Brief updated successfully.');
    }

    /**
     * Remove the specified brief from storage.
     */
    public function destroy(Brief $brief)
    {
        $this->authorizeBrief($brief);

        if ($brief->attachment_path) {
            Storage::disk('public')->delete($brief->attachment_path);
        }

        $brief->delete();

        return redirect()->route('briefs.index')->with('success', 'Brief deleted successfully.');
    }

    /**
     * Ensure the brief belongs to the current user.
     */
    private function authorizeBrief(Brief $brief)
    {
        if ($brief->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
    }
}

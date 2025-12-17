<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BriefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $briefs = Brief::where('user_id', auth()->id())->latest()->get();
        return view('briefs.index', compact('briefs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('briefs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Brief::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'attachment_path' => $path,
        ]);

        return redirect()->route('briefs.index')->with('success', 'Brief created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }
        return view('briefs.show', compact('brief'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }
        return view('briefs.edit', compact('brief'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
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
            'attachment_path' => $brief->attachment_path, // Explicitly set to key updated above or existing
        ]);

        return redirect()->route('briefs.show', $brief)->with('success', 'Brief updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }

        if ($brief->attachment_path) {
            Storage::disk('public')->delete($brief->attachment_path);
        }

        $brief->delete();

        return redirect()->route('briefs.index')->with('success', 'Brief deleted successfully.');
    }

    public function generateAi(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }

        \App\Jobs\ProcessBriefAi::dispatch($brief);

        return redirect()->route('briefs.show', $brief)->with('success', 'AI processing started. Refresh in a few moments.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009

class BriefController extends Controller
{
    /**
<<<<<<< HEAD
     * Display a listing of the resource.
     */
    public function index()
    {
        $briefs = Brief::where('user_id', auth()->id())->latest()->get();
=======
     * Display a listing of the user's briefs.
     */
    public function index()
    {
        $briefs = Brief::where('user_id', Auth::id())->latest()->get();
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
        return view('briefs.index', compact('briefs'));
    }

    /**
<<<<<<< HEAD
     * Show the form for creating a new resource.
=======
     * Show the form for creating a new brief.
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
     */
    public function create()
    {
        return view('briefs.create');
    }

    /**
<<<<<<< HEAD
     * Store a newly created resource in storage.
=======
     * Store a newly created brief in storage.
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
<<<<<<< HEAD
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $path = null;
=======
            'attachment' => 'nullable|file|max:2048', // 2MB max
        ]);

        $path = null;

>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Brief::create([
<<<<<<< HEAD
            'user_id' => auth()->id(),
=======
            'user_id' => Auth::id(),
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
            'title' => $validated['title'],
            'content' => $validated['content'],
            'attachment_path' => $path,
        ]);

        return redirect()->route('briefs.index')->with('success', 'Brief created successfully.');
    }

    /**
<<<<<<< HEAD
     * Display the specified resource.
     */
    public function show(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }
=======
     * Display the specified brief.
     */
    public function show(Brief $brief)
    {
        $this->authorizeBrief($brief);

>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
        return view('briefs.show', compact('brief'));
    }

    /**
<<<<<<< HEAD
     * Show the form for editing the specified resource.
     */
    public function edit(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }
=======
     * Show the form for editing the specified brief.
     */
    public function edit(Brief $brief)
    {
        $this->authorizeBrief($brief);

>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
        return view('briefs.edit', compact('brief'));
    }

    /**
<<<<<<< HEAD
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }
=======
     * Update the specified brief in storage.
     */
    public function update(Request $request, Brief $brief)
    {
        $this->authorizeBrief($brief);
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
<<<<<<< HEAD
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
=======
            'attachment' => 'nullable|file|max:2048',
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
        ]);

        if ($request->hasFile('attachment')) {
            // Delete old file if exists
            if ($brief->attachment_path) {
                Storage::disk('public')->delete($brief->attachment_path);
            }
<<<<<<< HEAD
=======

>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
            $brief->attachment_path = $request->file('attachment')->store('attachments', 'public');
        }

        $brief->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
<<<<<<< HEAD
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
=======
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
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009

        if ($brief->attachment_path) {
            Storage::disk('public')->delete($brief->attachment_path);
        }

        $brief->delete();

        return redirect()->route('briefs.index')->with('success', 'Brief deleted successfully.');
    }

<<<<<<< HEAD
    public function generateAi(Brief $brief)
    {
        if ($brief->user_id !== auth()->id()) {
            abort(403);
        }

        \App\Jobs\ProcessBriefAi::dispatch($brief);

        return redirect()->route('briefs.show', $brief)->with('success', 'AI processing started. Refresh in a few moments.');
=======
    /**
     * Ensure the brief belongs to the current user.
     */
    private function authorizeBrief(Brief $brief)
    {
        if ($brief->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
    }
}

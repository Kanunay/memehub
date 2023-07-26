<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all();
        return view('media.index', compact('media'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:picture,video',
        'file' => 'required|mimes:jpeg,png,mp4|max:2048',
        'description' => 'nullable|string|max:500', // Add validation rule for description
    ]);

    $file = $request->file('file');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads'), $filename);

    // Retrieve the authenticated user's ID
    $userId = Auth::id();

    Media::create([
        'user_id' => $userId, // Save the user ID
        'title' => $request->input('title'),
        'type' => $request->input('type'),
        'filename' => $filename,
        'description' => $request->input('description'), // Save the description
    ]);

    return redirect()->back()->with('success', 'Media uploaded successfully!');
}

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->back()->with('success', 'Media deleted successfully!');
    }

    public function edit($id)
    {
        // Find the media item by ID
        $media = Media::findOrFail($id);

        // Pass the $media variable to the view
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|max:255',
        'type' => 'required|in:picture,video',
    ]);

    $media = Media::findOrFail($id);
    $media->title = $request->input('title');
    $media->type = $request->input('type');

    // Handle file upload if a new file is provided
    if ($request->hasFile('file')) {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,mp4|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        // Delete the previous file if it exists
        if (file_exists(public_path('uploads/' . $media->filename))) {
            unlink(public_path('uploads/' . $media->filename));
        }

        $media->filename = $filename;
    }

    // Update the description field
    $media->description = $request->input('description');

    $media->save();

    return redirect()->route('media.index')->with('success', 'Media item updated successfully!');
}

}

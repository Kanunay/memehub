<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

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
            'file' => 'required|mimes:jpeg,png,mp4|max:2048', // Adjust the allowed mime types and maximum file size as needed
        ]);

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        Media::create([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'filename' => $filename,
        ]);

        return redirect()->back()->with('success', 'Media uploaded successfully!');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->back()->with('success', 'Media deleted successfully!');
    }
}

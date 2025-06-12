<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VideoController extends Controller
{
    public function create()
    {
        return Inertia::render('AddVideo');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'video' => 'required|file|mimes:mp4,mov,avi|max:102400' // 100MB max
            ]);

            $videoFile = $request->file('video');
            $path = $videoFile->store('videos', 'public');

            if (!$path) {
                throw new \Exception('Failed to store video file');
            }

            // Generate thumbnail (you'll need to implement this)
            $thumbnailPath = $this->generateThumbnail($videoFile);

            $video = Video::create([
                'title' => $request->title,
                'file_path' => $path,
                'thumbnail_path' => $thumbnailPath,
                'user_id' => Auth::id(),
                'visibility' => 'public',
                'views' => 0,
                'likes' => 0
            ]);

            return back()->with('success', 'Video uploaded successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            // Clean up the uploaded file if video creation fails
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()->with('error', 'Failed to upload video: ' . $e->getMessage());
        }
    }

    private function generateThumbnail($videoFile)
    {
        // TODO: Implement thumbnail generation using FFmpeg
        // For now, return null as we haven't implemented thumbnail generation yet
        return null;
    }
}

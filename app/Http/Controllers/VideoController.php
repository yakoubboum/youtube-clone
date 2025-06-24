<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

class VideoController extends Controller
{
    public function create()
    {
        $videos = Video::where('user_id', Auth::id())->get();

        return Inertia::render('AddVideo', [
            'videos' => $videos
        ]);
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $request->validate([
                'title' => 'required|string|max:255',
                'video' => 'required|file|mimes:mp4,mov,avi|max:102400',
                'thumbnail' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $videoFile = $request->file('video');
            $thumbnailFile = $request->file('thumbnail');

            // Get original filename and extension
            $originalName = $videoFile->getClientOriginalName();
            $extension = $videoFile->getClientOriginalExtension();
            $fileNameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);

            // Create unique filename
            $uniqueFileName = $fileNameWithoutExtension . '-' . uniqid() . '.' . $extension;

            // Store in public storage for public videos, private for private videos
            $visibility = $request->input('visibility', 'public');
            $disk = $visibility === 'public' ? 'public' : 'private';
            $path = $videoFile->storeAs('videos', $uniqueFileName, $disk);

            if (!$path) {
                throw new \Exception('Failed to store video file');
            }

            // Handle thumbnail
            $thumbnailPath = null;
            if ($thumbnailFile) {
                // If user uploaded a thumbnail, store it
                $thumbnailName = 'thumb-' . uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailPath = 'thumbnails/' . $thumbnailName;
                $thumbnailFile->storeAs('thumbnails', $thumbnailName, $disk);
            } else {
                // Generate thumbnail from video if no thumbnail was uploaded
                Log::info('Starting thumbnail generation');
                $thumbnailPath = $this->generateThumbnail($videoFile, $visibility);
                Log::info('Finished thumbnail generation');
            }

            $video = Video::create([
                'title' => $request->title,
                'file_path' => $path,
                'original_filename' => $originalName,
                'thumbnail_path' => $thumbnailPath,
                'user_id' => Auth::id(),
                'visibility' => $visibility,
                'views' => 0,
                'likes' => 0
            ]);

            DB::commit();
            return back()->with('success', 'Video uploaded successfully');
        } catch (\Exception $e) {
            if (isset($path)) {
                Storage::disk($disk)->delete($path);
            }
            if (isset($thumbnailPath)) {
                Storage::disk($disk)->delete($thumbnailPath);
            }
            DB::rollBack();
            return back()->with('error', 'Failed to upload video: ' . $e->getMessage());
        }
    }

    private function generateThumbnail($videoFile, $disk = 'public')
    {
        try {
            // Ensure thumbnails directory exists
            $thumbnailDir = storage_path('app/public/thumbnails');
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Log video file path
            Log::info('Processing video file: ' . $videoFile->getPathname());

            // Create FFmpeg instance with configuration
            $ffmpeg = FFMpeg::create(config('ffmpeg'));

            // Get video duration
            $video = $ffmpeg->open($videoFile->getPathname());
            $duration = $video->getStreams()->first()->get('duration');

            Log::info('Video duration: ' . $duration);

            // Generate thumbnail at 25% of video duration
            $thumbnailTime = $duration * 0.25;
            $thumbnailPath = 'thumbnails/' . uniqid() . '.jpg';

            Log::info('Generating thumbnail at: ' . $thumbnailTime . ' seconds');
            Log::info('Thumbnail will be saved to: ' . $thumbnailPath);

            $frame = $video->frame(TimeCode::fromSeconds($thumbnailTime));
            $frame->save(storage_path('app/public/' . $thumbnailPath));

            // Verify thumbnail was created
            if (!file_exists(storage_path('app/public/' . $thumbnailPath))) {
                throw new \Exception('Thumbnail file was not created');
            }

            return $thumbnailPath;
        } catch (\Exception $e) {
            Log::error('Thumbnail generation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    public function show($id)
    {
        $video = Video::with('user')->findOrFail($id);
        $video->increment('views');

        return Inertia::render('Video', [
            'video' => $video
        ]);
    }

    public function destroy($id)
    {
        try {
            $video = Video::where('user_id', Auth::id())->findOrFail($id);

            // Delete video file
            if ($video->file_path) {
                $disk = $video->visibility === 'public' ? 'public' : 'private';
                Storage::disk($disk)->delete($video->file_path);
            }

            // Delete thumbnail
            if ($video->thumbnail_path) {
                $disk = $video->visibility === 'public' ? 'public' : 'private';
                Storage::disk($disk)->delete($video->thumbnail_path);
            }

            // Delete from database
            $video->delete();

            return back()->with('success', 'Video deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete video: ' . $e->getMessage());
        }
    }

    public function like($id)
    {
        try {
            $video = Video::findOrFail($id);
            $video->increment('likes');

            return response()->json(['success' => true, 'likes' => $video->likes], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

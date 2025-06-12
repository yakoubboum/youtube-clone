<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoStreamController extends Controller
{
    public function stream(Request $request, $filename)
    {
        // Get video from database
        $video = Video::where('file_path', 'videos/' . $filename)->first();

        if (!$video) {
            abort(404);
        }

        // If video is public, redirect to direct URL
        if ($video->visibility === 'public') {
            return redirect()->to('/storage/' . $video->file_path);
        }

        // For private videos, check permissions and stream
        if ($video->visibility === 'private') {
            if (!Auth::check()) {
                abort(403, 'Unauthorized');
            }

            if (Auth::id() !== $video->user_id) {
                abort(403, 'Unauthorized');
            }

            $path = storage_path('app/private/videos/' . $filename);

            if (!file_exists($path)) {
                abort(404);
            }

            $size = filesize($path);
            $start = 0;
            $end = $size - 1;

            if ($request->headers->has('Range')) {
                $range = $request->header('Range');
                if (preg_match('/bytes=(\d+)-(\d+)?/', $range, $matches)) {
                    $start = intval($matches[1]);
                    if (isset($matches[2])) {
                        $end = intval($matches[2]);
                    }
                }
            }

            $length = $end - $start + 1;

            $response = new StreamedResponse(function () use ($path, $start, $length) {
                $handle = fopen($path, 'rb');
                fseek($handle, $start);
                echo fread($handle, $length);
                fclose($handle);
            });

            $response->headers->set('Content-Type', 'video/mp4');
            $response->headers->set('Content-Length', $length);
            $response->headers->set('Accept-Ranges', 'bytes');
            $response->headers->set('Content-Range', "bytes $start-$end/$size");
            $response->setStatusCode($request->headers->has('Range') ? 206 : 200);

            return $response;
        }

        abort(404);
    }
}

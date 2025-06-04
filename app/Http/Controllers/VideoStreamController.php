<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoStreamController extends Controller
{
    public function stream(Request $request, $filename)
    {
        $path = storage_path('app/public/videos/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $size = filesize($path);
        $start = 0;
        $end = $size - 1;

        if ($request->headers->has('Range')) {
            $range = $request->header('Range');
            preg_match('/bytes=(\d+)-(\d+)?/', $range, $matches);
            $start = intval($matches[1]);
            if (isset($matches[2])) {
                $end = intval($matches[2]);
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
}

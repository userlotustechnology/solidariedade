<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class S3BrowserController extends Controller
{
    public function index(Request $request)
    {
        $disk = 's3';
        $path = $request->get('path', '');
        $files = Storage::disk($disk)->files($path);
        $directories = Storage::disk($disk)->directories($path);

        // Gerar links temporários para cada arquivo
        $fileLinks = [];
        foreach ($files as $file) {
            try {
                $fileLinks[$file] = Storage::disk($disk)->temporaryUrl($file, now()->addMinutes(5));
            } catch (\Exception $e) {
                $fileLinks[$file] = null;
            }
        }

        return view('s3browser.index', [
            'files' => $files,
            'fileLinks' => $fileLinks,
            'directories' => $directories,
            'currentPath' => $path,
        ]);
    }
}

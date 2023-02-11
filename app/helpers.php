<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('saveImage')) {
    function saveImage($file)
    {
        $fileName = 'images/' . Str::random(15) . time() . '.' . $file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($fileName)) {
            Storage::disk('public')->put($fileName, File::get($file), 'public');
        }

        return $fileName;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

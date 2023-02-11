<?php

namespace App\Traits;

trait HandleImage
{
    public function getFileName($file): string
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    public function deleteImage($imageCurrent, $path)
    {
        if (file_exists($path . $imageCurrent)) {
            unlink($path . $imageCurrent);
        }
    }

    public function updateImage($file, $imageCurrent, $path)
    {
        $imageName = $imageCurrent;
        if (isset($file)) {
            $imageName = $this->getFileName($file);
            $this->deleteImage($imageCurrent, $path);
            $this->moveImage($file, $path);
        }
        return $imageName;
    }

    //  check Images
    public function verify($file): bool
    {
        return (bool)$file;
    }

    public function moveImage($file, $path): string
    {
        $imageName = $this->getFileName($file);
        $file->move($path, $imageName);
        return $imageName;
    }
}



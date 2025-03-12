<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUpdateTrait {
    public function handleFileUpdate(Request $request, string $fileName, ?string $oldPath = null, string $dir = 'uploads'): ?String
    {
        //check if request has file
        if(!$request->hasFile($fileName)) {
            return null;
        }
        // xoa file cu neu co
        if($oldPath && File::exists($oldPath)) {
            File::delete(public_path($oldPath));
        }

        //upload file
        $file = $request->file($fileName);
        $extension = $file->getClientOriginalExtension();
        $uploadFileName = \Str::random(30).'.'.$extension;
        $file->move(public_path($dir), $uploadFileName);

        $filePath = $dir.'/'.$uploadFileName;

        return $filePath;
    }

    public function deleteFile($path)
    {
        if($path && File::exists($path)) {
            File::delete(public_path($path));
        }
    }
}
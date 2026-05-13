<?php

namespace App\Shared\Services;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads'
    ): string {

        return Storage::disk('public')
            ->put($directory, $file);
    }

    public function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    public function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return Storage::url($path);
    }
}
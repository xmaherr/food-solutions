<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Uploads a given file or processes an external URL string.
     *
     * @param UploadedFile|string|null $file
     * @param string $folder
     * @param string|null $oldPath
     * @return string|null Returns the path to the stored file.
     */
    public function upload($file, string $folder, ?string $oldPath = null): ?string
    {
        if (!$file) {
            return $oldPath;
        }

        // If it's an uploaded file
        if ($file instanceof UploadedFile) {
            // Delete old file if exists
            if ($oldPath) {
                $this->delete($oldPath);
            }

            // Generate unique filename with original extension
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Store in the 'public' disk
            // File will be stored in storage/app/public/{folder}/{filename}
            return $file->storeAs($folder, $filename, 'public');
        }

        // If it's already a string (maybe existing path or external URL)
        // Keep it as is or handle custom logic if necessary.
        return is_string($file) ? $file : $oldPath;
    }

    /**
     * Deletes a file from the public storage disk.
     *
     * @param string|null $path
     * @return bool
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        // Only delete from storage if it's not an external URL starting with http
        if (!Str::startsWith($path, ['http://', 'https://'])) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}

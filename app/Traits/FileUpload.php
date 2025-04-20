<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public function upload(UploadedFile $uploadedFile, ?int $userId = null, string $disk = 'local', string $folder = 'edu'): string
    {
        return $uploadedFile->storeAs($folder, sprintf('%s_%s_%s', time(), $userId ?? uniqid('', true), $uploadedFile->getClientOriginalName()), [
            'disk' => $disk
        ]);
    }

    public function delete(?string $filePath, string $disk = 'local'): bool
    {
        if ($filePath === null) {
            return false;
        }

        return Storage::disk($disk)->exists($filePath) && Storage::disk($disk)->delete($filePath);
    }
}

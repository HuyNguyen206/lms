<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUpload
{
    public function upload(UploadedFile $uploadedFile, ?int $userId = null, string $disk = 'local'): string
    {
        return $uploadedFile->storeAs('edu', sprintf('%s_%s_%s', time(), $userId ?? uniqid('', true), $uploadedFile->getClientOriginalName()), [
            'disk' => $disk
        ]);
    }
}

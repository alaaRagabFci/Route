<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * uploadFile
     *
     * @param  string $folderPath
     * @param  mixed $uploadedFile
     * @param  mixed $parentID
     */
    public static function uploadFile(string $folderPath, $uploadedFile, $parentID = null)
    {
        $path = $parentID ? $folderPath . '/' . $parentID . '/' : $folderPath . '/';

        return $uploadedFile->store($path . date('FY'), 'public');
    }

    /**
     * deletePicture
     *
     * @param  mixed $picture
     * @return void
     */
    public static function deletePicture(?string $picture): void
    {
        if ($picture) {
            Storage::delete($picture);
        }
    }
}

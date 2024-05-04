<?php

namespace App\Actions\Generic;

use App\Helpers\FileHelper;
use App\Http\Requests\Generic\UploadRequest;
use App\Http\Resources\SuccessResource;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadAction
{
    use AsAction;

    /**
     * asController
     *
     * @param UploadRequest $request
     */
    public function asController(UploadRequest $request)
    {
        $path = FileHelper::uploadFile($request->dir, $request->file, $request->parent_id);

        return new SuccessResource(200, [
            "path" => $path
        ]);
    }
}

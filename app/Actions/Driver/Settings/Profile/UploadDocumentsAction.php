<?php

namespace App\Actions\Driver\Settings\Profile;

use App\Http\Requests\Driver\Settings\Profile\UploadDocumentsRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class UploadDocumentsAction
{
    use AsAction;

    /**
     * asController
     *
     * @param UploadDocumentsRequest $request
     * @param User $user
     * @return mixed
     */
    public function asController(UploadDocumentsRequest $request, User $user): mixed
    {
        try {
            $user->update([
                'profile_image' => $request->profile_image,
            ]);

            $user->document()->updateOrCreate(['user_id' => $user->id], $request->validated());

            return new SuccessResource(
                Response::HTTP_OK,
                __('response.data_updated')
            );
        } catch (Exception $ex) {
            return new ErrorResource(
                Response::HTTP_BAD_REQUEST,
                $ex->getMessage()
            );
        }
    }
}

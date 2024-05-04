<?php

namespace App\Actions\User\Settings\Profile;

use App\Helpers\FileHelper;
use App\Http\Resources\{ErrorResource, SuccessResource};
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserImageAction
{
    use AsAction;

    /**
     * asController
     *
     * @param  User $user
     * @return mixed
     */
    public function asController(User $user): mixed
    {
        try {
            FileHelper::deletePicture($user->profile_image);

            $user->update([
                'profile_image' => null
            ]);

            return new SuccessResource(
                Response::HTTP_NO_CONTENT,
                __('response.data_updated')
            );
        } catch (\Exception $ex) {
            return new ErrorResource(
                Response::HTTP_BAD_REQUEST,
                $ex->getMessage()
            );
        }
    }
}

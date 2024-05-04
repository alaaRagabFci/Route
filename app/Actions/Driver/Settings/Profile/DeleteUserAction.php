<?php

namespace App\Actions\Driver\Settings\Profile;

use App\Helpers\FileHelper;
use App\Http\Resources\{ErrorResource, SuccessResource};
use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserAction
{
    use AsAction;

    /**
     * @param User $user
     * @return ErrorResource|SuccessResource
     */
    public function asController(User $user)
    {
        try {
            $authenticatedUser = auth()->user();
            if ($authenticatedUser->id != $user->id) {
                throw new Exception('Forbidden.');
            }

            $countDeletedAccounts = User::where('email', 'like', '%' . $user->email . '_Deleted' . '%')->count();

            FileHelper::deletePicture($user->profile_image);
            $user->update([
                'email' => $user->email . '_Deleted_' . $countDeletedAccounts + 1,
                'status' => false,
                'phone' => $user->phone . '_Deleted_' . $countDeletedAccounts + 1,
            ]);

            return new SuccessResource(
                Response::HTTP_NO_CONTENT,
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

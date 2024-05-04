<?php

namespace App\Actions\User\Settings\Profile;

use App\Http\Requests\User\Settings\Profile\UpdateUserRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use App\Models\User;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class EditUserAction
{
    use AsAction;

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return mixed
     */
    public function asController(UpdateUserRequest $request, User $user): mixed
    {
        try {
            $user->update($request->validated());

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

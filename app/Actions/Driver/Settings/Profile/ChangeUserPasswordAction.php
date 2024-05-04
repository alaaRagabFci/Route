<?php

namespace App\Actions\Driver\Settings\Profile;

use App\Actions\Generic\User\ChangeUserPassword;
use App\Http\Requests\Driver\Settings\Profile\ChangeUserPasswordRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;

class ChangeUserPasswordAction
{
    use AsAction;

    /**
     * asController
     *
     * @param  ChangeUserPasswordRequest $request
     * @return mixed
     */
    public function asController(ChangeUserPasswordRequest $request): mixed
    {
        try {
            ChangeUserPassword::run($request->old_password, auth()->user(), $request->password);

            return new SuccessResource(
                Response::HTTP_OK,
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

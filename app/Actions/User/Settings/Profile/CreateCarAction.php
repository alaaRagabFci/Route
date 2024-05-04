<?php

namespace App\Actions\User\Settings\Profile;

use App\Enums\UserStatusEnum;
use App\Http\Requests\User\Settings\Profile\CreateCarRequest;
use App\Http\Resources\{ErrorResource, SuccessResource};
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class CreateCarAction
{
    use AsAction;

    /**
     * asController
     *
     * @param CreateCarRequest $request
     * @param User $user
     * @return mixed
     */
    public function asController(CreateCarRequest $request, User $user): mixed
    {
        try {
            $user->car()->updateOrCreate(['user_id' => $user->id], $request->validated());

            $user->update([
               'status' => UserStatusEnum::APPROVED->value,
            ]);

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

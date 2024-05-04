<?php

namespace App\Actions\User\Settings\Profile;

use App\Http\Requests\User\Settings\Profile\ViewUserRequest;
use App\Http\Resources\Driver\Users\UserResource;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewUserAction
{
    use AsAction;

    /**
     * asController
     *
     * @param  ViewUserRequest $viewUserRequest
     * @param  User $user
     * @return UserResource
     */
    public function asController(ViewUserRequest $viewUserRequest, User $user): UserResource
    {
        return new UserResource($user);
    }
}

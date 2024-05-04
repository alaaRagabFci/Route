<?php

namespace App\Actions\Driver\Settings\Profile;

use App\Http\Requests\Driver\Settings\Profile\ViewUserRequest;
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

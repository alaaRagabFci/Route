<?php

namespace App\Actions\Generic\Auth;

use App\Enums\UserTypesEnum;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterAccount
{
    use AsAction;

    /**
     * @param array $data
     * @param string $status
     * @param string $type
     * @return User
     */
    public function handle(array $data, string $status, string $type): User
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'status' => $status,
            'country_code' => $data['country_code'],
            'type' => $type,
        ]);

        return $user;
    }
}

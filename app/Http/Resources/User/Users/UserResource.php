<?php

namespace App\Http\Resources\Driver\Users;

use App\Enums\UserStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'profile_image' => $this->profile_image,
            'status' => $this->status,
            'profile_completed' => (bool)$this->document,
        ];
    }
}

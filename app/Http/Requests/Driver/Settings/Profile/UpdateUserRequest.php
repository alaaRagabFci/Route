<?php

namespace App\Http\Requests\Driver\Settings\Profile;

use App\Enums\UserTypesEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user->id == $this->user->id && $this->user->type == UserTypesEnum::DRIVER->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'profile_image' => 'nullable|string',
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('auth.name_required'),
            'name.string' => __('auth.name_type'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.error_email'),
            'email.unique' => __('auth.email_unique'),
            'phone.required' => __('auth.phone_required'),
            'phone.unique' => __('auth.phone_unique'),
        ];
    }
}

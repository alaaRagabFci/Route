<?php

namespace App\Http\Requests\User\Settings\Profile;

use App\Enums\UserTypesEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user->type == UserTypesEnum::USER->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
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
            'old_password.required' => __('auth.old_password_required'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
        ];
    }
}

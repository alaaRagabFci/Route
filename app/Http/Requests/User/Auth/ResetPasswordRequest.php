<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_code' => 'required|string',
            'phone' => 'required',
            'otp' => 'required|integer',
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
            'phone.required' => __('auth.phone_required'),
            'otp.required' => __('auth.otp_required'),
            'otp.integer' => __('auth.error_otp'),
            'password.required' => __('auth.password_required'),
            'password.confirmed' => __('auth.password_confirmation'),
            'password.min' => __('auth.password_min'),
        ];
    }
}

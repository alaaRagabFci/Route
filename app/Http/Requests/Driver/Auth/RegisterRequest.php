<?php

namespace App\Http\Requests\Driver\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'country_code' => 'required|string',
            'phone' => 'required|string|unique:users,phone',
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
            'first_name.required' => __('auth.first_name_required'),
            'first_name.string' => __('auth.first_name_type'),
            'last_name.required' => __('auth.last_name_required'),
            'last_name.string' => __('auth.last_name_type'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.error_email'),
            'email.unique' => __('auth.email_unique'),
            'password.required' => __('auth.password_required'),
            'password.confirmed' => __('auth.password_confirmation'),
            'password.min' => __('auth.password_min'),
            'phone.string' => __('auth.phone_type'),
            'phone.unique' => __('auth.phone_unique'),
        ];
    }
}

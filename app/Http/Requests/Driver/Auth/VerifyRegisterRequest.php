<?php

namespace App\Http\Requests\Driver\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VerifyRegisterRequest extends FormRequest
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
            'phone' => 'required',
            'country_code' => 'required|string',
            'otp' => 'required|integer',
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
        ];
    }
}

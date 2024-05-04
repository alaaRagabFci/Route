<?php

namespace App\Http\Requests\Driver\Settings\Profile;

use App\Enums\UserTypesEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentsRequest extends FormRequest
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
            'profile_image' => 'required|string',
            'driver_license' => 'required|string',
            'vehicle_license' => 'required|string',
            'vehicle_image' => 'required|string',
            'national_id' => 'required|string',
            'criminal_record' => 'required|string',
            'tow_truck_registration' => 'nullable|string',
            'car_spec' => 'nullable|string',
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
            'profile_image.required' => __('document.profile_image_required'),
            'driver_license.required' => __('document.driver_license_required'),
            'vehicle_license.required' => __('document.vehicle_license_required'),
            'vehicle_image.required' => __('document.vehicle_image_required'),
            'national_id.required' => __('document.national_id_required'),
            'criminal_record.required' => __('document.criminal_record_required'),
        ];
    }
}

<?php

namespace App\Http\Requests\User\Settings\Profile;

use App\Enums\UserTypesEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user->id == $this->user->id && $this->user->type == UserTypesEnum::USER->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'model_id' => 'required|integer|exists:models,id',
            'registration_year' => 'required|integer',
        ];
    }
}

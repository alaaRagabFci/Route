<?php

namespace App\Http\Requests\Generic;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'file' => 'required|mimes:webp,jpeg,png,jpg,pdf,doc,docx,mp4|max:102400',
            'dir' => 'required|string|in:users',
            'parent_id' => 'nullable|integer'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'user_id' => 'required|exists:users,id',
        ];
    }
}

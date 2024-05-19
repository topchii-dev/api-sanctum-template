<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'email',
                'unique:users,email',
                'string',
                'max:255',
                'required'
            ],
            'password' => [
                'string',
                'min:6',
                'max:255',
                'required'
            ],
            'name' => [
                'string',
                'max:255',
                'required'
            ]
        ];
    }
}

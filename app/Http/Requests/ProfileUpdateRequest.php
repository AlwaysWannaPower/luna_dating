<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'avatar' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp'])->max(5 * 1024)],

            'birth_date' => [
                'nullable',
                'date',
                'before:' . now()->subYears(16)->format('Y-m-d'),
            ],

            'gender' => [
                'nullable',
                Rule::in(['male', 'female']),
            ],

            'looking_for' => [
                'nullable',
                Rule::in(['male', 'female', 'both']),
            ],

            'city' => ['nullable', 'string', 'max:100'],

            'bio' => ['nullable', 'string', 'max:1000'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:80',
            ],

            'sport' => [
                'required',
                'string',
                Rule::in([
                    'football',
                    'basketball',
                    'volleyball',
                ]),
            ],

            'city' => [
                'nullable',
                'string',
                'max:120',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1500',
            ],

            'max_members' => [
                'nullable',
                'integer',
                'min:2',
                'max:100',
            ],
        ];
    }
}

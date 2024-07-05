<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequestWeb;

class LoginRequest extends BaseFormRequestWeb
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dni' => [
                'required',
                'string',
                'min:8',
                'regex:/^[0-9]+$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ]
        ];
    }
}

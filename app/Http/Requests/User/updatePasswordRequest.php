<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequestWeb;

class updatePasswordRequest extends BaseFormRequestWeb
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
            'password_actually' => 'required|string',
            'password' => 'required|confirmed|min:8|string'
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class createRequestUnit extends BaseFormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users,email',
            'dni' => 'required|string|max:8|min:8|unique:users,dni|regex:/^[0-9]+$/',
        ];
    }
}

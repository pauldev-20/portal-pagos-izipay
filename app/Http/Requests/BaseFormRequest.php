<?php

namespace App\Http\Requests;

use App\Exceptions\JsonAuthorizationException;
use App\Exceptions\JsonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    protected function failedAuthorization()
    {
        throw new JsonAuthorizationException();
    }

    
    protected function failedValidation(Validator $validator)
    {
        throw new JsonValidationException($validator);
    }
}

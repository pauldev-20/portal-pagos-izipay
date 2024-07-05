<?php

namespace App\Http\Requests;

use App\Exceptions\JsonAuthorizationWebException;
use App\Exceptions\JsonValidationWebException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequestWeb extends FormRequest
{
    protected function failedAuthorization()
    {
        throw new JsonAuthorizationWebException();
    }

    
    protected function failedValidation(Validator $validator)
    {
        throw new JsonValidationWebException($validator);
    }
}

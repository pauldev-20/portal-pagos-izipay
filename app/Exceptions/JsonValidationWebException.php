<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;

class JsonValidationWebException extends Exception
{
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator=$validator;
    }

    public function report(){
        return false;
    }

    public function render($request){
        return redirect()->back()->withErrors($this->validator->errors())->withInput();
    }
}

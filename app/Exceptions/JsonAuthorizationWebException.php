<?php

namespace App\Exceptions;

use Exception;

class JsonAuthorizationWebException extends Exception
{
    public function report()
    {
        return false;
    }

    public function render($request)
    {
        return response()->json([
            "message" => "No autorizado"
        ],403);
    }
}

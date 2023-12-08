<?php

namespace App\Exceptions;

use Exception;

class GeneralJsonException extends Exception
{
    public function render($request) {
        $code = ($this->code) ? $this->code : 500;

        return response()->json([
            "errors" => [ "message" => $this->getMessage() ]
        ], $code);
    }
}

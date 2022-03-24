<?php

namespace App\Exceptions;

use Exception;

class GameDateException extends Exception
{
    public function render($request)
    {
        return response()->json(["error" => true, "message" => "The is no fixture this day ($request->date) for that team."]);  
    }
}

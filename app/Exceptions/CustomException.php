<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([ 
            "error" => array( 
                "message" => $this->getMessage(), 
                'code' => $this->getCode(),
                "file" => $this->getFile(),
                'line' => $this->getLine(),
                'report' => env('MAIL_FROM_ADDRESS', 'hello@example.com')
            )]
        );
    }
}

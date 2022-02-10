<?php
 
namespace App\Exceptions;
use Inertia\Inertia;
 
use Exception;
 
class CustomException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report() {}
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return Inertia::render("Error", [
            "msg" => $this->message,
            "cod" => $this->code 
        ]);
    }
}


<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class RestApiException extends Exception
{
    /**
     * Report Exception
     * 
     * @return void
     */

    public function report(){
        //Log::debug('User Not ');
    }
}

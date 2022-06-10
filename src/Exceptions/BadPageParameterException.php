<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Exceptions;

use Exception;

class BadPageParameterException extends Exception
{
    public function __construct()
    {
        $this->message = 'Bad parameters: page submitted to registry has to provide an array parameters with a "class" and a "route" keys';
    }
}

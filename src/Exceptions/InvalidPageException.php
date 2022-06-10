<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Exceptions;

use Exception;

class InvalidPageException extends Exception
{
    public function __construct($classname)
    {
        $this->message = "$classname is not a valid Page class";
    }
}

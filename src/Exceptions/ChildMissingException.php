<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Exceptions;

use Exception;

class ChildMissingException extends Exception
{
    public function __construct($classname)
    {
        $this->message = "Child $classname does not exist";
    }
}

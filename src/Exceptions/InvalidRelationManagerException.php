<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Exceptions;

use Exception;

class InvalidRelationManagerException extends Exception
{
    public function __construct($classname)
    {
        $this->message = "$classname is not a valid RelationManager class";
    }
}

<?php declare(strict_types=1);

namespace undercoder\procwrapper\customexceptions;

use \Exception;

class InvalidStringCommandException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = $message ??
        "A valid not empty string was expected. Cant create a CommandInterface implementor instance.";
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

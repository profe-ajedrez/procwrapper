<?php declare(strict_types=1);

namespace undercoder\procwrapper\customexceptions;

use \Exception;

class InvalidRedirectorException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = $message ??
        "A valid redirector expected when redirectedOutputRun() called";
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

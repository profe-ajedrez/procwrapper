<?php declare(strict_types=1);

namespace undercoder\procwrapper\customexceptions;

use \Exception;

class NoIntegerIndexedArgumentArrayException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = $message ?? "The arguments array is not integer indexed.";
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

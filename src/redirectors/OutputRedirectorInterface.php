<?php declare(strict_types=1);

namespace undercoder\procwrapper\redirectors;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

interface OutputRedirectorInterface
{
    public function redirect(string $output) : void;
}

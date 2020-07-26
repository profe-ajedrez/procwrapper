<?php declare(strict_types=1);

namespace undercoder\procwrapper\redirectors;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use undercoder\procwrapper\redirectors\OutputRedirectorInterface;

class NullRedirector implements OutputRedirectorInterface
{
    public function redirect(string $output) : void
    {
        // do nothing;
    }
}

<?php declare(strict_types=1);

namespace undercoder\procwrapper\commands;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

interface CommandInterface
{
    public function parseCommand() : array;
    public function pushArgument(string $argument);
    public function popArgument() : string;
}

<?php declare(strict_types=1);

namespace undercoder\procwrapper\commands;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use undercoder\procwrapper\commands\CommandInterface;
use undercoder\procwrapper\customexceptions\InvalidStringCommandException;
use undercoder\procwrapper\customexceptions\NoIntegerIndexedArgumentArrayException;

class ShellCommand implements CommandInterface
{
    protected string $command;
    protected array $arguments;

    public function __construct(string $command, array $arguments = [])
    {
        $this->throwExceptionOnEmpty($command);
        $this->throwExceptionOnNoIntegerIndexedArray($arguments);
        $this->command   = $command;
        $this->arguments = $arguments;
    }

    public function pushArgument(string $argument)
    {
        $this->throwExceptionOnEmpty($argument);
        array_push($this->arguments[], $argument);
    }

    public function popArgument() : string
    {
        return array_pop($this->arguments);
    }

    public function parseCommand() : array
    {
        $this->throwExceptionOnNoIntegerIndexedArray($this->arguments);
        $parsed = array_merge([$this->command], $this->arguments);
        return $parsed;
    }

    private function throwExceptionOnEmpty(string $str)
    {
        if (empty($str)) {
            throw new InvalidStringCommandException();
        }
    }

    private function throwExceptionOnNoIntegerIndexedArray(array $arguments)
    {
        if (empty($arguments)) {
            return;
        }
        if (count(array_filter(array_keys($arguments), 'is_string')) > 0) {
            throw new NoIntegerIndexedArgumentArrayException();
        }
    }
}

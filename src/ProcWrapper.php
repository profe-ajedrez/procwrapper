<?php declare(strict_types=1);

namespace undercoder\procwrapper;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use undercoder\procwrapper\redirectors\OutputRedirectorInterface;
use undercoder\procwrapper\commands\CommandInterface;
use undercoder\procwrapper\customexceptions\InvalidRedirectorException;
use undercoder\procwrapper\redirectors\NullRedirector;

/**
 * ProcWrapper
 *
 * Simple wrapper to encapsulate calls to Symfony\Component\Process\Process
 */
class ProcWrapper
{
    protected OutputRedirectorInterface $redirector;
    protected CommandInterface $command;
    protected Process $process;

    public function __construct(CommandInterface $command, OutputRedirectorInterface $redirector = null)
    {
        $this->command    = $command;
        if ($redirector === null) {
            $this->redirector = new NullRedirector;
        } else {
            $this->redirector = $redirector;
        }
        $this->process    = new Process($command->parseCommand());
    }


    public function redirectedOutputRun()
    {
        if (is_null($this->redirector)) {
            throw new InvalidRedirectorException();
        }
        foreach ($this->process as $type => $data) {
            $this->redirector->redirect($data);
        }
    }

    public function run(?callable $callback = null)
    {
        if (is_null($callback)) {
            $this->process->run();
        } else {
            $this->process->run($callback);
        }
    }

    public function start()
    {
        $this->process->start();
    }

    public function wait(?callable $callback = null)
    {
        if (is_null($callback)) {
            $this->process->wait();
        } else {
            $this->process->wait($callback);
        }
    }

    public function waitUntil(callable $callback)
    {
        $this->process->waitUntil($callback);
    }
}

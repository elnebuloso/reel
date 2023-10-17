<?php

namespace App;

use Symfony\Component\Process\Process;

/**
 * ProcessFactory
 */
class ProcessFactory
{
    /**
     * @param array $command
     * @param string|null $cwd
     * @param array|null $env
     * @param mixed|null $input
     * @param float|null $timeout
     * @return Process
     */
    public function create(array $command, string $cwd = null, array $env = null, mixed $input = null, ?float $timeout = 60): Process
    {
        return new Process($command, $cwd, $env, $input, $timeout);
    }
}

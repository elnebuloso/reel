<?php

namespace App\Domain;

/**
 * Reel
 */
class Reel
{
    public const VERSION = "v1";

    /**
     * @var array<Job>
     */
    private array $jobs = [];

    /**
     * @param Job $job
     * @return void
     */
    public function addJob(Job $job): void
    {
        $this->jobs[$job->getName()] = $job;
    }

    /**
     * @return array
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }
}

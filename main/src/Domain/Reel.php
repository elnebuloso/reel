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
     * @var array<Property>
     */
    private array $properties = [];

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

    /**
     * @param Property $property
     * @return void
     */
    public function addProperty(Property $property): void {
        $this->properties[$property->getPath()] = $property;
    }

    /**
     * @return array<Property>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}

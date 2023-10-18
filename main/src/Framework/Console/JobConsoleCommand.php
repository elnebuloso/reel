<?php

namespace App\Framework\Console;

use App\Domain\Job;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * JobConsoleCommand
 */
class JobConsoleCommand extends Command
{
    /**
     * @var Job
     */
    private Job $job;

    /**
     * @var InputInterface
     */
    private InputInterface $input;

    /**
     * @var OutputInterface
     */
    private OutputInterface $output;

    /**
     * @param Job $job
     * @param string|null $name
     */
    public function __construct(Job $job, string $name = null)
    {
        $this->job = $job;

        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName($this->job->getName());
        $this->setDescription($this->job->getDesc());
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        try {
            $this->runPipeline();
        } catch (Throwable $e) {
            $output->writeln($e->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * @return void
     */
    private function runPipeline(): void
    {
        $this->output->writeln("<fg=green>{$this->job->getDesc()}</>");

        foreach ($this->job->getScripts() as $script) {
            $this->runPipelineScript($script);
        }
    }

    /**
     * @param string $script
     * @return void
     */
    private function runPipelineScript(string $script): void
    {
        $this->output->writeln("<fg=cyan>$script</>");
        passthru($script);
    }
}

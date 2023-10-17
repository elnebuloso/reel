<?php

namespace App\Framework\Console;

use App\Domain\Command\Pipeline;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * PipelineConsole
 */
class PipelineConsole extends Command
{
    /**
     * @var Pipeline
     */
    private Pipeline $pipeline;

    /**
     * @var InputInterface
     */
    private InputInterface $input;

    /**
     * @var OutputInterface
     */
    private OutputInterface $output;

    /**
     * @param Pipeline $pipeline
     * @param string|null $name
     */
    public function __construct(Pipeline $pipeline, string $name = null)
    {
        $this->pipeline = $pipeline;

        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName($this->pipeline->getName());
        $this->setDescription($this->pipeline->getDesc());
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
        $this->output->writeln("<fg=green>{$this->pipeline->getDesc()}</>");

        foreach ($this->pipeline->getScripts() as $script) {
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

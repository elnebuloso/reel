<?php

namespace App\Commands;

use App\Domain\Command\Pipeline;
use App\ProcessFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * DynamicCommand
 */
class DynamicCommand extends Command
{
    /**
     * @var Pipeline
     */
    private Pipeline $pipeline;

    /**
     * @var ProcessFactory
     */
    private ProcessFactory $processFactory;

    /**
     * @var OutputInterface
     */
    private OutputInterface $output;

    /**
     * @param Pipeline $pipeline
     * @param ProcessFactory $processFactory
     * @param string|null $name
     */
    public function __construct(Pipeline $pipeline, ProcessFactory $processFactory, string $name = null)
    {
        $this->pipeline = $pipeline;
        $this->processFactory = $processFactory;

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

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;

        $this->output->writeln("<info>{$this->pipeline->getDesc()}</info>");

        try {
            foreach ($this->pipeline->getScripts() as $script) {
                $this->onScript($script);
            }
        } catch (Throwable $e) {
            $output->writeln($e->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * @param string $script
     * @return void
     */
    private function onScript(string $script): void
    {
        $process = $this->processFactory->create(["/bin/sh", "-c", $script]);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });
    }
}

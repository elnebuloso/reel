<?php

namespace App\Commands;

use App\CommandConfig;
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
     * @var CommandConfig
     */
    private CommandConfig $commandConfig;

    /**
     * @var ProcessFactory
     */
    private ProcessFactory $processFactory;

    /**
     * @var OutputInterface
     */
    private OutputInterface $output;

    /**
     * @param CommandConfig $commandConfig
     * @param ProcessFactory $processFactory
     * @param string|null $name
     */
    public function __construct(CommandConfig $commandConfig, ProcessFactory $processFactory, string $name = null)
    {
        $this->commandConfig = $commandConfig;
        $this->processFactory = $processFactory;

        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName($this->commandConfig->getName());
        $this->setDescription($this->commandConfig->getDesc());
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;

        $this->output->writeln("<info>{$this->commandConfig->getDesc()}</info>");

        try {
            foreach ($this->commandConfig->getScripts() as $script) {
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

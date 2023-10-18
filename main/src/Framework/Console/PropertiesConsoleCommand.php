<?php

namespace App\Framework\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * PropertiesConsoleCommand
 */
class PropertiesConsoleCommand extends Command
{
    private const NAME = "properties";

    private const DESCRIPTION = "Show all evaluated and compiled available properties";

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription(self::DESCRIPTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("<info>" . self::DESCRIPTION . "</info>");

        return Command::SUCCESS;
    }
}
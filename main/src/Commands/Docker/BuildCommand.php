<?php

namespace App\Commands\Docker;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BuildCommand
 */
class BuildCommand extends Command
{
    const NAME = "docker:build";

    const DESCRIPTION = "Building Docker Container";

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

        passthru("docker build --rm --pull --file Dockerfile --target prod --tag reel-demo-project-tmp .");

        return Command::SUCCESS;
    }
}

<?php

namespace App\Framework\Console;

use App\Domain\Reel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * PropertiesConsoleCommand
 */
class PropertiesConsoleCommand extends Command
{
    /**
     * @var Reel
     */
    private Reel $reel;

    /**
     * @param Reel $reel
     * @param string|null $name
     */
    public function __construct(Reel $reel, string $name = null)
    {
        $this->reel = $reel;

        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName("properties");
        $this->setDescription("show all evaluated and compiled available properties");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->renderProperties($output);

        return self::SUCCESS;
    }

    private function renderProperties(OutputInterface $output): void {
        $table = new Table($output);
        $table->setHeaders(['path', 'value', 'file']);

        foreach ($this->reel->getProperties() as $property) {
            $table->addRow([
                $property->getPath(),
                $property->getValue(),
                $property->getFile()->getPathname()
            ]);
        }

        $table->render();
    }
}

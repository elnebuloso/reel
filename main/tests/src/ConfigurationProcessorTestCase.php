<?php

namespace AppTests;

use App\ConfigurationProcessor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigurationProcessorTestCase
 */
class ConfigurationProcessorTestCase extends TestCase
{
    /**
     * @test
     * @dataProvider configurationDataProvider
     * @param string $what
     * @return void
     */
    public function testProcess(string $what): void
    {
        $config = $this->getConfig($what);
        $expected = $this->getExpected($what);

        $configurationProcessor = new ConfigurationProcessor();
        $this->assertEquals($expected, $configurationProcessor->process([$config]));
    }

    /**
     * @return array[]
     */
    public function configurationDataProvider(): array
    {
        return [["valid"]];
    }

    /**
     * @param string $what
     * @return string
     */
    private function getConfig(string $what): string
    {
        return __DIR__ . "/../resources/configuration/$what.yml";
    }

    /**
     * @param string $what
     * @return array
     */
    private function getExpected(string $what): array
    {
        return json_decode(file_get_contents(__DIR__ . "/../resources/configuration/$what.json"), true);
    }
}

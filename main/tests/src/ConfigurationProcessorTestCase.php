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
     * @param string $config
     * @param array $expected
     * @return void
     */
    public function testProcess(string $config, array $expected): void
    {
        $configurationProcessor = new ConfigurationProcessor();
        $this->assertEquals($expected, $configurationProcessor->process([$config]));
    }

    /**
     * @return array
     */
    public function configurationDataProvider(): array
    {
        return [
            [__DIR__ . "/../resources/configuration/valid.yml", $this->getExpected("valid")],
            [__DIR__ . "/../../reel.yml", $this->getExpected("reel")]
        ];
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

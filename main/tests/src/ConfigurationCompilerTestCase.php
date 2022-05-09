<?php

namespace AppTests;

use App\ConfigurationCompiler;
use PHPUnit\Framework\TestCase;
use Twig\Error\LoaderError as TwigLoaderError;
use Twig\Error\RuntimeError as TwigRuntimeError;
use Twig\Error\SyntaxError as TwigSyntaxError;

/**
 * Class ConfigurationCompilerTestCase
 */
class ConfigurationCompilerTestCase extends TestCase
{
    /**
     * @test
     * @dataProvider compileDataProvider
     * @param array $data
     * @return void
     * @throws TwigLoaderError
     * @throws TwigRuntimeError
     * @throws TwigSyntaxError
     */
    public function testCompile(array $data): void
    {
        $compiler = new ConfigurationCompiler();
        $result = $compiler->compile($data["config"]);
        $this->assertEquals($data["expected"], $result);
    }

    /**
     * @return array
     */
    public function compileDataProvider(): array
    {
        return [
            ["config" => [], "expected" => []]
        ];
    }
}

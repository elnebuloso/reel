<?php

namespace App;

use App\Domain\Glue\Trait\ArrayKeyPathsToScalarValuesTrait;
use App\Domain\Twig\PropertiesTwigExtension;
use Jasny\DotKey\DotKey;
use Twig\Environment as TwigEnvironment;
use Twig\Error\LoaderError as TwigLoaderError;
use Twig\Error\RuntimeError as TwigRuntimeError;
use Twig\Error\SyntaxError as TwigSyntaxError;
use Twig\Loader\ArrayLoader as TwigArrayLoader;

/**
 * ConfigurationCompiler
 */
class ConfigurationCompiler
{
    use ArrayKeyPathsToScalarValuesTrait;

    /**
     * @param array $data
     * @param array $skipPaths
     * @return array
     * @throws TwigLoaderError
     * @throws TwigRuntimeError
     * @throws TwigSyntaxError
     */
    public function compile(array $data, array $skipPaths = []): array
    {
        $paths = $this->arrayKeyPathsToScalarValues($data);

        foreach ($paths as $path) {
            if ($this->skipPath($path, $skipPaths)) {
                continue;
            }

            $value = DotKey::on($data)->get($path);

            if (is_string($value)) {
                $twigEnvironment = $this->createTwigEnvironment($value);
                DotKey::on($data)->set($path, $twigEnvironment->render("template", $data));
            }
        }

        return $data;
    }

    /**
     * @param string $value
     * @return TwigEnvironment
     */
    private function createTwigEnvironment(string $value): TwigEnvironment
    {
        $twigLoader = new TwigArrayLoader(["template" => $value]);

        $twigEnvironment = new TwigEnvironment($twigLoader);
        $twigEnvironment->addExtension(new PropertiesTwigExtension());

        return $twigEnvironment;
    }

    /**
     * @param string $path
     * @param array $skipPaths
     * @return bool
     */
    private function skipPath(string $path, array $skipPaths): bool
    {
        foreach ($skipPaths as $skipPath) {
            if (stripos($path, $skipPath) !== false) {
                return true;
            }
        }

        return false;
    }
}

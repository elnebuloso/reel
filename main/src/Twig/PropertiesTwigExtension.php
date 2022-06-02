<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Cocur\Slugify\Slugify;

/**
 * Class PropertiesTwigExtension
 */
class PropertiesTwigExtension extends AbstractExtension
{
    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter("md5", [$this, "md5"]),
            new TwigFilter("sha1", [$this, "sha1"]),
            new TwigFilter("slugify", [$this, "slugify"]),
            new TwigFilter("basename", [$this, "basename"]),
            new TwigFilter("truncate", [$this, "truncate"]),
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction("env", [$this, "env"]),
            new TwigFunction("file", [$this, "file"]),
            new TwigFunction("current_dir", [$this, "currentDir"]),
        ];
    }

    /**
     * @param string $string
     * @return string
     */
    public function md5(string $string): string
    {
        return md5($string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function sha1(string $string): string
    {
        return sha1($string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function slugify(string $string): string
    {
        return (new Slugify())->slugify($string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function basename(string $string): string
    {
        return basename($string);
    }

    /**
     * @param string $value
     * @param int $length
     * @param string $replace
     * @return string
     */
    public function truncate(string $value, int $length, string $replace = ""): string
    {
        return strlen($value) <= $length ? $value : substr($value, 0, $length - strlen($replace)) . $replace;
    }

    /**
     * @param string $variable
     * @return string
     */
    public function env(string $variable): string
    {
        return (string)getenv($variable);
    }

    /**
     * @param string $filename
     * @return string
     */
    public function file(string $filename): string
    {
        return trim(file_get_contents($filename));
    }

    /**
     * @return string
     */
    public function currentDir(): string
    {
        return getcwd();
    }
}

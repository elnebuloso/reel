<?php

namespace App\Domain\Glue;

use Symfony\Component\Yaml\Parser;

/**
 * YamlParserFactory
 */
class YamlParserFactory
{
    /**
     * @return Parser
     */
    public function create(): Parser {
        return new Parser();
    }
}

<?php

namespace AppTests;

use App\Redo;
use PHPUnit\Framework\TestCase;

/**
 * Class RedoTestCase
 */
class RedoTestCase extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testMajorVersion(): void
    {
        $this->assertEquals(1, Redo::VERSION_MAJOR);
    }
}

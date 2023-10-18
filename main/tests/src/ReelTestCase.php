<?php

namespace AppTests;

use App\Domain\Reel;
use PHPUnit\Framework\TestCase;

/**
 * Class ReelTestCase
 */
class ReelTestCase extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testMajorVersion(): void
    {
        $this->assertEquals(1, Reel::VERSION_MAJOR);
    }
}

<?php

namespace Orchestra\Testbench\Tests;

use Orchestra\Testbench\TestCase;

class DefaultConfigurationTest extends TestCase
{
    /** @test */
    public function it_populate_expected_cache_defaults()
    {
        $this->assertEquals(isset($_SERVER['TESTBENCH_PACKAGE_TESTER']) ? 'file' : 'array', $this->app['config']['cache.default']);
    }

    /** @test */
    public function it_populate_expected_session_defaults()
    {
        $this->assertEquals(isset($_SERVER['TESTBENCH_PACKAGE_TESTER']) ? 'file' : 'array', $this->app['config']['session.driver']);
    }
}

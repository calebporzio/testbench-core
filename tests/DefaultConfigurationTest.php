<?php

namespace Orchestra\Testbench\Tests;

use Carbon\CarbonInterface;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Support\Facades\Date;
use Orchestra\Testbench\Foundation\Env;
use Orchestra\Testbench\TestCase;

class DefaultConfigurationTest extends TestCase
{
    /** @test */
    public function it_populate_expected_debug_config()
    {
        $this->assertSame((Env::get('TESTBENCH_PACKAGE_TESTER') === true ? true : false), $this->app['config']['app.debug']);
    }

    /**
     * @test
     *
     * @group phpunit-configuration
     */
    public function it_populate_expected_app_key_config()
    {
        $this->assertSame('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF', $this->app['config']['app.key']);
    }

    /** @test */
    public function it_populate_expected_testing_config()
    {
        tap($this->app['config']['database.connections.testing'], function ($config) {
            $this->assertTrue(isset($config));
            $this->assertEquals([
                'driver' => 'sqlite',
                'database' => ':memory:',
                'foreign_key_constraints' => false,
            ], $config);
        });

        $this->assertTrue($this->usesSqliteInMemoryDatabaseConnection('testing'));
        $this->assertFalse($this->usesSqliteInMemoryDatabaseConnection('sqlite'));
    }

    /** @test */
    public function it_populate_expected_cache_defaults()
    {
        $this->assertEquals((Env::get('TESTBENCH_PACKAGE_TESTER') === true ? 'file' : 'array'), $this->app['config']['cache.default']);
    }

    /** @test */
    public function it_populate_expected_session_defaults()
    {
        $this->assertEquals((Env::get('TESTBENCH_PACKAGE_TESTER') === true ? 'file' : 'array'), $this->app['config']['session.driver']);
    }

    /** @test */
    public function it_uses_mutable_dates_by_default()
    {
        $date = Date::parse('2023-01-01');

        $this->assertInstanceOf(CarbonInterface::class, $date);
        $this->assertInstanceOf(DateTimeInterface::class, $date);
        $this->assertNotInstanceOf(DateTimeImmutable::class, $date);
    }
}

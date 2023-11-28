<?php

namespace Orchestra\Testbench\Foundation\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Orchestra\Testbench\Foundation\Concerns\HandlesDatabaseConnections;

class SyncDatabaseEnvironmentVariables
{
    use HandlesDatabaseConnections;

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app): void
    {
        tap($app['config'], function ($config) {
            $this->usesDatabaseConnectionsEnvironmentVariables($config, 'mysql', 'MYSQL');
            $this->usesDatabaseConnectionsEnvironmentVariables($config, 'pgsql', 'POSTGRES');
            $this->usesDatabaseConnectionsEnvironmentVariables($config, 'sqlsrv', 'MSSQL');
        });
    }
}
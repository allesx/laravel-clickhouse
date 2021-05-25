<?php

declare(strict_types=1);

namespace Allesx\LaravelClickHouse;

use Allesx\LaravelClickHouse\Database\Connection;
use Allesx\LaravelClickHouse\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;

class ClickHouseServiceProvider extends ServiceProvider
{
    /**
     * @throws
     *
     * @return void
     */
    public function boot(): void
    {
        Model::setConnectionResolver($this->app['db']);
        Model::setEventDispatcher($this->app['events']);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->resolving('db', static function (DatabaseManager $db) {
            $db->extend('allesx::clickhouse', static function ($config, $name) {
                return new Connection(\array_merge($config, \compact('name')));
            });
        });
    }
}

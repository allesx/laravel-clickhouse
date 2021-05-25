<?php

declare(strict_types=1);

namespace Allesx\LaravelClickHouse\Database;

use Allesx\LaravelClickHouse\Database\Query\Builder;
use Allesx\LaravelClickHouse\Database\Query\Pdo;
use Tinderbox\ClickhouseBuilder\Query\Grammar;

class Connection extends \Tinderbox\ClickhouseBuilder\Integrations\Laravel\Connection
{
    /**
     * @return Builder|\Tinderbox\ClickhouseBuilder\Integrations\Laravel\Builder
     */
    public function query()
    {
        return new Builder($this, new Grammar());
    }

    /**
     * @return Pdo
     */
    public function getPdo()
    {
        return app(Pdo::class);
    }
}

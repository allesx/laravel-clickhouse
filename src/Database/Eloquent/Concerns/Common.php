<?php

declare(strict_types=1);

namespace Allesx\LaravelClickHouse\Database\Eloquent\Concerns;

trait Common
{
    /**
     * Save the model to the database.
     *
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = []): bool
    {
        return static::insert($this->toArray());
    }
}

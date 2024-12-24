<?php

namespace Core\Traits;

use PDO;

trait Queryable
{
    static protected ?string $tableName = null;

    static  string $query = '';

    protected array $commands = [];

    static protected function resetQuery(): void
    {
        static::$query = '';
    }

    static public function select(array $columns = ['*']): static
    {
        static ::resetQuery();
        static ::$query .= 'SELECT ' . implode(', ', $columns) . ' FROM ' . static::$tableName;
//dd(static::$query);
        $obj =new static;
        $obj->commands[] = 'select';

        return $obj;
    }

    public function get(): array
    {
        return db()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }
}
<?php

namespace Core\Traits;

use App\Enums\JOIN;
use App\Enums\SQL;
use Exception;
use PDO;

trait Queryable
{
    static protected ?string $tableName = null;

    static string $query = '';

    protected array $commands = [];

    public function __call(string $name, array $arguments)
    {
        if (in_array($name, ['where', 'join'])) {
            return call_user_func_array([$this, $name], $arguments);
        }
        throw new Exception("Method not allowed", 422);
    }

    static public function __callStatic(string $name, array $arguments)
    {
        if (in_array($name, ['where', 'join'])) {
            return call_user_func_array([new static, $name], $arguments);
        }
        throw new Exception("Method not allowed", 422);
    }

    static protected function resetQuery(): void
    {
        static::$query = '';
    }

    static public function select(array $columns = ['*']): static
    {
        static::resetQuery();
        static::$query .= 'SELECT ' . implode(', ', $columns) . ' FROM ' . static::$tableName;
        $obj = new static;
        $obj->commands[] = 'select';

        return $obj;
    }

    static public function find(int $id): static|false
    {
        $query = db()->prepare('SELECT * FROM ' . static::$tableName . ' WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    static public function findBy(string $column, mixed $value): static|false
    {
        $query = db()->prepare("SELECT * FROM  " . static::$tableName . "  WHERE $column = :$column");
        $query->bindParam($column, $value);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    static public function all(): array
    {
        return static::select()->get();
    }

    static public function create(array $fields): bool
    {
        $params = static::prepareCreateParams($fields);
        $query = db()->prepare('INSERT INTO ' . static::$tableName . "($params[keys]) VALUES($params[placeholders])");

        return $query->execute($fields);
    }

    static public function createAndReturn(array $fields): null|static
    {
        static::create($fields);

        return static::find(db()->lastInsertId());
    }

    static protected function prepareCreateParams(array $fields): array
    {
        $keys = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $keys);

        return
            [
                'keys' => implode(', ', $keys),
                'placeholders' => implode(', ', $placeholders)
            ];
    }

    static protected function delete(int $id): bool
    {
        $query = db()->prepare('DELETE FROM ' . static::$tableName . ' WHERE id = :id');
        $query->bindParam('id', $id, PDO::PARAM_INT);

        return $query->execute();
    }

    public function destroy(): bool
    {
        return static::delete($this->id);
    }

    public function update(array $fields): static
    {
        $query = db()->prepare('UPDATE ' .
            static::$tableName .
            ' SET ' .
            $this->updatePlaceHolders($fields) .
            ' WHERE id = :id');
        $fields['id'] = $this->id;
        $query->execute($fields);

        return static::find($this->id);
    }

    public function exists(): bool
    {
        $this->required(['select'], 'Method exists() can not be called without');
        return !empty($this->get());
    }

    public function join(string $table, array $conditions, $joinType = JOIN::LEFT): static
    {
        $this->required(['select'], 'JOIN can not be called without');

        $obj = in_array('select', $this->commands) ? $this : static::select();

        $obj->commands[] = 'join';

        $conditions = array_map(fn($condArr) => "$condArr[left] $condArr[operator] $condArr[right]", $conditions);
        static::$query .= " $joinType JOIN $table ON" . implode(', ', $conditions);

        return $obj;
    }

    public function orderBy(array $columns): static
    {
        $this->required(['select'], 'ORDER BY can not be called without');

        $this->commands[] = 'order';

        static::$query .= " ORDER BY ";

        $lastKey = array_key_last($columns);

        foreach ($columns as $column => $direction) {
            static::$query .= $column . ' ' . $direction . ($column === $lastKey ? '' : ', ');
        }

        return $this;
    }

    public function get(): array
    {
        return db()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function toSql(): string
    {
        return static::$query;
    }

    public function and(string $column, SQL $operator = SQL::EQUAL, mixed $value = null): static
    {
        $this->required(['where'], "AND can not be used without");

        static::$query .= ' AND ';
        $this->commands[] = 'and';

        return $this->where($column, $operator, $value);
    }

    public function or(string $column, SQL $operator = SQL::EQUAL, mixed $value = null): static
    {
        $this->required(['where'], "AND can not be used without");

        static::$query .= ' OR ';
        $this->commands[] = 'or';

        return $this->where($column, $operator, $value);
    }

    protected function where(string $column, SQL $operator = SQL::EQUAL, mixed $value = null): static
    {
        $this->prevent(['order', 'limit', 'having', 'group'], 'WHERE cat not be used after');
        $obj = in_array('select', $this->commands) ? $this : static::select();
        //dd($value);
        $value = $this->transformWhereValue($value);


        if (!in_array('where', $obj->commands)) {
            static::$query .= ' WHERE ';
            $obj->commands[] = 'where';
        }

        static::$query .= "$column $operator->value $value";

        return $obj;
    }

    protected function transformWhereValue(mixed $value): string|int|float
    {
        $checkOnString = fn($v) => !is_null($v)
            && !is_bool($v)
            && !is_numeric($v)
            && !is_array($v)
            && $v !== SQL::NULL->value;

        if ($checkOnString($value)) {
            $value = "'$value'";
        }

        if (is_null($value)) {
            $value = SQL::NULL->value;
        }

        if (is_array($value)) {
            $value = array_map(fn($v) => $checkOnString($v) ? "'$v'" : $v, $value);
            $value = '(' . implode(', ', $value) . ')';
        }

        if (is_bool($value)) {
            $value = $value ? 'TRUE' : 'FALSE';
        }
        // dd($value);
        return $value;
    }

    protected function prevent(array $preventCommands, string $massage = ''): void
    {
        foreach ($preventCommands as $command) {
            if (in_array($command, $this->commands)) {
                $massage = sprintf(
                    '%s: %s [%s]',
                    static::class,
                    $massage,
                    $command
                );
                throw new Exception($massage, 422);
            }
        }
    }

    protected function required(array $requiredCommands, string $massage = ''): void
    {
        foreach ($requiredCommands as $command) {
            if (!in_array($command, $this->commands)) {
                $massage = sprintf(
                    '%s: %s [%s]',
                    static::class,
                    $massage,
                    $command
                );
                throw new Exception($massage, 422);
            }
        }
    }

    protected function updatePlaceHolders(array $fields): string
    {
        $keys = array_map(fn($key) => "$key => :$key", array_keys($fields));

        return implode(', ', $keys);
    }
}
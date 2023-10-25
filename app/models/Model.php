<?php

namespace app\models;

use app\database\Connect;

abstract class Model {

    protected string $table;

    public function find(string $field, mixed $value)
    {
        $connection = Connect::connect();
        $prepare = $connection->prepare("select * from {$this->table} where {$field} = :{$field}");
        $prepare->execute([$field => $value]);

        return $prepare->fetchObject(static::class);
    }
}
?>
<?php

namespace app\models;

class User extends Model {

    protected string $table = 'users';

    public readonly int $id;
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $password;
}
?>
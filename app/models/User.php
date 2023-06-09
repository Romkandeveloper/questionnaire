<?php

namespace app\models;

use core\Model;
use lib\db;

class User extends Model
{
    /**
     * @param array $data
     * @return void
     */
    static public function create(array $data)
    {
        $db = new Db;

        return $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }

    static public function getByEmail(string $email)
    {
        $db = new Db;

        return $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email]);
    }

    static public function getById(int $id)
    {
        $db = new Db;

        return $db->query('SELECT * FROM users WHERE id = :id', ['id' => $id]);
    }
}
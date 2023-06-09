<?php

namespace lib;

use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $dbConfig = require 'config/db.php';

        $this->db = new PDO(
            'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'],
            $dbConfig['user'],
            $dbConfig['password']
        );
    }

    public function query($sql, $params = [], $returnId = false)
    {
        if (!empty($params)) {
            $smtp = $this->db->prepare($sql);
            foreach ($params as $key => $val) {
                $smtp->bindValue(':' . $key, $val);
            }

            $smtp->execute();
        } else {
            $smtp = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        return $returnId ? $this->db->lastInsertId() : $smtp->fetchAll(PDO::FETCH_ASSOC);
    }
}
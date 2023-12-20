<?php

namespace App\Database;

abstract class Database {
    protected $pdo;

    public function __construct(){
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $dbport = getenv('DB_PORT');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$dbport}";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
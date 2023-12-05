<?php

namespace App\Database;

abstract class Connection {
    protected $pdo;

    public function __construct() {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $dbport = getenv('DB_PORT');

        $dsn = "mysql:host={$host};dbname={$dbname};port=${dbport}";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        // $this->mysqli = new \mysqli($host, $user, $pass, $dbname, $dbport);

        // // Verificar a conexão
        // if ($this->mysqli->connect_error) {
        //     die('Erro na conexão com o banco de dados: ' . $this->mysqli->connect_error);
        // }
    }
}

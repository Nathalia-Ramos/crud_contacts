<?php 

namespace App\Database;

class LojasDao extends Connection {
    public function __construct (){
        
        parent::__construct();
        
    }

    public function getStore() {
        $lojas = $this->pdo->query('SELECT * FROM lojas ORDER BY id desc')->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach ($lojas as $loja) {
            var_dump($loja);
        }

        die;

    } 
}




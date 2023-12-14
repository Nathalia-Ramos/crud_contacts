<?php

namespace App\models;

use App\Database\Database;

class Contacts extends Database {
    public function __construct (){
        
        parent::__construct();
        
    }

    public function getAllContacts() {
        $result = $this->pdo->query('SELECT * FROM contacts ORDER BY id desc')->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
 
    } 
}
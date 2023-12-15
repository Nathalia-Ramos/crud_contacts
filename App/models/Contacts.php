<?php

namespace App\models;

use App\Database\Database;

class Contacts extends Database {
    public function __construct (){
        
        parent::__construct();
        
    }

    public function createContact() {
        $query = $this->pdo->prepare("INSERT INTO contacts(full_name, date_of_birth, mail, profession, telephone, cellphone, have_whatsapp, send_mail, send_sms)VALUES(?, ?, ?, ?, ?, ?, ?, ?,?)");

        $query->bindParam(1, $full_name);
        $query->bindParam(2, $date_of_birth);
        $query->bindParam(3, $mail);
        $query->bindParam(4, $profession);
        $query->bindParam(5, $telephone);
        $query->bindParam(6, $cellphone);
        $query->bindParam(7, $have_whatsapp);
        $query->bindParam(8, $send_mail);
        $query->bindParam(9, $send_sms);

        $query->execute();
    }

    public function getAllContacts() {
        $result = $this->pdo->query('SELECT * FROM contacts ORDER BY id desc')->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
 
    } 
}
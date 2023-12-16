<?php

namespace App\models;

use App\Database\Database;

class Contacts extends Database {
    public function __construct (){
        
        parent::__construct();
        
    }

    public function createContact($full_name, $birthday, $mail, $occupation, $phone, $cellphone, $have_whatsapp, $send_mail_permission, $send_sms_permission) {
        $query = $this->pdo->prepare("INSERT INTO contacts(full_name, birthday, mail, occupation, phone, cellphone, have_whatsapp, send_mail_permission, send_sms_permission)VALUES(?, ?, ?, ?, ?, ?, ?, ?,?)");

        $query->bindParam(1, $full_name);
        $query->bindParam(2, $birthday);
        $query->bindParam(3, $mail);
        $query->bindParam(4, $occupation);
        $query->bindParam(5, $phone);
        $query->bindParam(6, $cellphone);
        $query->bindParam(7, $have_whatsapp);
        $query->bindParam(8, $send_mail_permission);
        $query->bindParam(9, $send_sms_permission);

        $query->execute();
    }
    public function getAllContacts() {
        $result = $this->pdo->query("
            SELECT 
                id, 
                full_name, 
                birthday, 
                mail, 
                occupation, 
                phone 
            FROM contacts 
            WHERE deleted = 0 AND actived = 1 
            ORDER BY id desc")->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }    

    public function getContactByMail($mail) {
        $query = $this->pdo->prepare('SELECT mail FROM contacts WHERE deleted = 0 AND actived = 1 AND mail = ?');
        $query->execute([$mail]);
    
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function getContactByPhone($phone) {
        $query = $this->pdo->prepare('SELECT phone FROM contacts WHERE deleted = 0 AND actived = 1 AND phone = ?');
        $query->execute([$phone]);
    
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function getContactByCellPhone($cellphone) {
        $query = $this->pdo->prepare('SELECT cellphone FROM contacts WHERE deleted = 0 AND actived = 1 AND cellphone = ?');
        $query->execute([$cellphone]);
    
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function getContactById($id) {
        $query = $this->pdo->prepare('SELECT id FROM contacts WHERE deleted = 0 AND actived = 1 AND id = ?');
        $query->execute([$id]);
    
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function updateDeleteContactById($id) {
        $query = $this->pdo->prepare('UPDATE contacts SET deleted = 1 WHERE id = ?');
        $query = $query->execute([$id]);
    }
}
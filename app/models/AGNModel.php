<?php

class AGNModel {
    use Model;

    protected $table = 'agn';

    public function getAGNByUserId($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $params = [':user_id' => $user_id];
        return $this->query($query, $params);
    }

    public function getUserId($agnid) {
        $query = "SELECT user_id FROM $this->table WHERE agn_id = $agnid";
        return $this->query($query);
    }

    public function editContactDetails($data) {
        $query = "UPDATE $this->table SET contact_office = :contact_office WHERE user_id = :user_id";
        $params = [
            ':contact_office' => $data['contact_office'],
            ':user_id' => $_SESSION['user_id']
        ];
        try {
            $this->query($query, $params);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }


    
}
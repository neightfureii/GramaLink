<?php

class EditRequestGN
{
    use Model;

    protected $table = 'editrequestsgn';

    public function newPersonalRequest($data) {
        // check if already a record is available
        $result = $this->query("SELECT * FROM $this->table WHERE gn_id = :gn_id AND status = 'pending'", [
            ':gn_id' => $data['gn_id']
        ]);
        if ($result) {
            $sql = "UPDATE $this->table SET image = :image WHERE gn_id = :gn_id AND status = 'pending'";
            $params = [
                ':gn_id' => $data['gn_id'],
                ':image' => $data['image']
            ];
        } else {
            $sql = "INSERT INTO $this->table (gn_id, image, status) VALUES (:gn_id, :image, :status)";
            $params = [
                ':gn_id' => $data['gn_id'],
                ':image' => $data['image'],
                ':status' => 'pending'
            ];
        }

        try {
            $this->query($sql, $params);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }

    public function newContactRequest($data) {
        // check if already a record is available
        $result = $this->query("SELECT * FROM $this->table WHERE gn_id = :gn_id AND status = 'pending'", [
            ':gn_id' => $data['gn_id']
        ]);
        if ($result) {
            $sql = "UPDATE $this->table SET email = :email, mobileNumber = :mobileNumber, address = :address, contact_office = :contact_office WHERE gn_id = :gn_id AND status = 'pending'";
            $params = [
                ':gn_id' => $data['gn_id'],
                ':email' => $data['email'],
                ':mobileNumber' => $data['mobileNumber'],
                ':contact_office' => $data['contact_office'],
                ':address' => $data['address']
            ];
        } else {
            $sql = "INSERT INTO $this->table (gn_id, email, mobileNumber, address, contact_office, status) VALUES (:gn_id, :email, :mobileNumber, :address, :contact_office, :status)";
            $params = [
                ':gn_id' => $data['gn_id'],
                ':email' => $data['email'],
                ':mobileNumber' => $data['mobileNumber'],
                ':address' => $data['address'],
                ':contact_office' => $data['contact_office'],
                ':status' => 'pending'
            ];
        }

        try {
            $this->query($sql, $params);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllRequests() {
        $sql = "SELECT * FROM $this->table WHERE status = 'pending'";
        return $this->query($sql);
    }

    public function getSpecificRequest($reqid) {
        $sql = "SELECT * FROM editrequestsgn WHERE editrequestgn_id = :editrequestgn_id";
        return $this->query($sql, [':editrequestgn_id' => $reqid]);
    }

    public function updateRequestStatus($id, $action) {
        $sql = "UPDATE editrequestsgn SET status = :status WHERE editrequestgn_id = :editrequestgn_id";
        $params = [
            ':editrequestgn_id' => $id,
            ':status' => $action
        ];
        return $this->query($sql, $params);
    }

}
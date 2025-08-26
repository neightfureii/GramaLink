<?php

class EditRequest
{
    use Model;

    protected $table = 'editrequests';

    public function newPersonalRequest($data) {
        // check if already a record is available
        $result = $this->query("SELECT * FROM editrequests WHERE citizen_id = :citizen_id AND status = 'pending'", [
            ':citizen_id' => $data['citizen_id']
        ]);
        if ($result) {
            $sql = "UPDATE editrequests SET image = :image, civil_status = :civil_status WHERE citizen_id = :citizen_id AND status = 'pending'";
            $params = [
                ':citizen_id' => $data['citizen_id'],
                ':image' => $data['image'],
                ':civil_status' => $data['civilstatus']
            ];
        } else {
            $sql = "INSERT INTO editrequests (citizen_id, image, civil_status, status) VALUES (:citizen_id, :image, :civil_status, :status)";
            $params = [
                ':citizen_id' => $data['citizen_id'],
                ':image' => $data['image'],
                ':civil_status' => $data['civilstatus'],
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
        $result = $this->query("SELECT * FROM editrequests WHERE citizen_id = :citizen_id AND status = 'pending'", [
            ':citizen_id' => $data['citizen_id']
        ]);
        if ($result) {
            $sql = "UPDATE editrequests SET email = :email, mobileNumber = :mobileNumber, address = :address WHERE citizen_id = :citizen_id AND status = 'pending'";
            $params = [
                ':citizen_id' => $data['citizen_id'],
                ':email' => $data['email'],
                ':mobileNumber' => $data['mobileNumber'],
                ':address' => $data['address']
            ];
        } else {
            $sql = "INSERT INTO editrequests (citizen_id, email, mobileNumber, address, status) VALUES (:citizen_id, :email, :mobileNumber, :address, :status)";
            $params = [
                ':citizen_id' => $data['citizen_id'],
                ':email' => $data['email'],
                ':mobileNumber' => $data['mobileNumber'],
                ':address' => $data['address'],
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

    public function getRequestsByCitizen($citizen_id) {
        $sql = "SELECT * FROM editrequests WHERE citizen_id = :citizen_id AND status = 'pending'";
        return $this->query($sql, [':citizen_id' => $citizen_id]);
    }

    public function getSpecificRequest($reqid) {
        $sql = "SELECT * FROM editrequests WHERE editrequest_id = :editrequest_id";
        return $this->query($sql, [':editrequest_id' => $reqid]);
    }

    public function updateRequestStatus($id, $action) {
        $sql = "UPDATE editrequests SET status = :status WHERE editrequest_id = :editrequest_id";
        $params = [
            ':editrequest_id' => $id,
            ':status' => $action
        ];
        return $this->query($sql, $params);
    }


}
<?php

class ApplicationEW {
    use Model;

    protected $table = 'application_ew';

    public function saveApplication($data) {
        $query = "INSERT INTO $this->table VALUES (:application_id, :type, :ownership, :reason)";
        $params = [
            ':application_id' => $data['application_id'],
            ':type' => $data['ewConnectionType'],
            ':ownership' => $data['ewOwnership'],
            ':reason' => $data['ewReason']
        ];    
        return $this->query($query, $params);
    }

    public function getApplicationDetails($id) {
        $query = "SELECT * FROM $this->table 
        JOIN applications ON applications.application_id = $this->table.application_id 
        JOIN citizen c ON applications.citizen_id = c.citizen_id
        JOIN users u ON c.user_id = u.user_id
        WHERE $this->table.application_id = :id";
        $params = [
            ":id"=> $id
        ];
        return $this->query($query, $params);
    }
}
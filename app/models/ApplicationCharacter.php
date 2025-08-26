<?php

class ApplicationCharacter {
    use Model;

    protected $table = 'application_character';

    public function saveApplication($data) {
        $query = "INSERT INTO $this->table VALUES (:application_id, :yearsLived, :occupation, :institute, :reason)";
        $params = [
            ':application_id' => $data['application_id'],
            ':yearsLived' => $data['characteryearsLived'],
            ':occupation' => $data['characterOccupation'],
            ':institute' => $data['characterInstitute'],
            ':reason' => $data['characterReason']
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
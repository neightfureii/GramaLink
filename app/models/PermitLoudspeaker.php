<?php

class PermitLoudspeaker {
    use Model;

    protected $table = 'permit_loudspeaker';

    public function savePermit($data) {
        $query = "INSERT INTO $this->table (permit_id, location, time) VALUES (:permit_id, :location, :time)";
        $params = [
            ':permit_id' => $data['permit_id'],
            ':location' => $data['event_location'],
            ':time' => $data['event_time']
        ];    
        return $this->query($query, $params);
    }  
    
    public function getPermitDetails($id) {
        $query = "SELECT * FROM $this->table 
        JOIN permits ON permits.permit_id = $this->table.permit_id 
        JOIN citizen c ON permits.citizen_id = c.citizen_id
        JOIN users u ON c.user_id = u.user_id
        WHERE $this->table.permit_id = :id";
        $params = [
            ":id"=> $id
        ];
        return $this->query($query, $params);
    }

}
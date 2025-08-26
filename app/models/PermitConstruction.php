<?php

class PermitConstruction {
    use Model;

    protected $table = 'permit_construction';

    public function savePermit($data) {
        $query = "INSERT INTO $this->table (permit_id, address, plan) VALUES (:permit_id, :address, :plan)";
        $params = [
            ':permit_id' => $data['permit_id'],
            ':address' => $data['site_address'],
            ':plan' => $data['building_plan']
        ];    
        return $this->query($query, $params);
    }  
    
    public function getPermitDetails($id) {
        $query = "SELECT * FROM $this->table, $this->table.address as conAddress 
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
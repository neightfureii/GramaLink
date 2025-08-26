<?php

class GNDivisions {
    use Model;

    protected $table = 'gndivisions';
    
    public function getAllDivisionsByAGN($agnid) {
        $query = "SELECT * FROM $this->table WHERE gndivisions.agn_id = :agn_id";
        $params = [':agn_id' => $agnid];
        return $this->query($query, $params);
    }

    
}
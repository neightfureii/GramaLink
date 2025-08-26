<?php

class PermitModel {
    use Model;

    protected $table = 'permits';

    public $errors = [];

    public function getPermitDetails($user_id) {
        $query = "SELECT * 
              FROM permits
              WHERE citizen_id = :id ORDER BY created_at DESC";
        $params = ['id' => $user_id];

        return $this->query($query, $params) ?? null;
    }

    public function getPermitDetailsByGN($user_id) {
        $query = "SELECT *, p.created_at as percreated_at
              FROM permits p
              JOIN citizen c ON p.citizen_id = c.citizen_id
              JOIN users u ON c.user_id = u.user_id
              WHERE gn_id = :id ORDER BY p.created_at DESC";
        $params = ['id' => $user_id];

        return $this->query($query, $params) ?? null;
    }

    public function getPermitDetailsByAGN($agnid) {
        $query = "SELECT *
              FROM permits p
              JOIN citizen c ON p.citizen_id = c.citizen_id
              JOIN gn ON p.gn_id = gn.gn_id
              JOIN users u ON c.user_id = u.user_id
              WHERE p.agn_id = :id AND p.status = 'forwarded'";
        $params = ['id' => $agnid];

        return $this->query($query, $params) ?? null;
    }

    public function getSpecificPermitById($permit_id) {
        $query = "SELECT * FROM $this->table WHERE permit_id = :id";
        $params = ['id'=> $permit_id];
        return $this->query($query, $params) ?? null;
    }

    public function savePermit($data) {
        $query = "INSERT INTO permits (citizen_id, gn_id, agn_id, type, reason, created_at, status) VALUES (:citizen_id, :gn_id, :agn_id, :type, :reason, :created_at, :status)";
        $params = [
            'citizen_id' => $data['citizen_id'],
            'gn_id' => $data['gn_id'],
            'agn_id' => $data['agn_id'],
            'type' => $data['documentType'],
            'reason' => $data['reason'],
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];    
        return $this->query($query, $params);
    }

    public function changeStatus($permit_id, $status) {
        $query = "UPDATE permits 
              SET status = :status
              WHERE permit_id = :id";

        $params = [
            'status' => $status,
            'id' => $permit_id
        ];

        return $this->query($query, $params);
    }

    public function getLastPermit() {
        $query = "SELECT * FROM permits ORDER BY permit_id DESC LIMIT 1";

        return $this->query($query)[0] ?? null;
    }

}
<?php

class ApplicationModel {
    use Model;

    protected $table = 'applications';

    public $errors = [];

    protected $allowedColumns = ['citizen_id', 'gn_id', 'preferred_date', 'preferred_time', 'service_type', 'description', 'documents', 'created_at', 'status', 'remarks'];

    public function getApplicationDetails($user_id) {
        $query = "SELECT * 
              FROM applications
              WHERE citizen_id = :id ORDER BY created_at DESC";
        $params = ['id' => $user_id];

        return $this->query($query, $params) ?? null;
    }

    public function getApplicationDetailsByGN($user_id) {
        $query = "SELECT *, a.created_at as appcreated_at
              FROM applications a
              JOIN citizen c ON a.citizen_id = c.citizen_id
              JOIN users u ON c.user_id = u.user_id
              WHERE gn_id = :id ORDER BY a.created_at DESC";
        $params = ['id' => $user_id];

        return $this->query($query, $params) ?? null;
    }

    public function getApplicationDetailsByAGN($agnid) {
        $query = "SELECT *
              FROM applications a
              JOIN citizen c ON a.citizen_id = c.citizen_id
              JOIN gn ON a.gn_id = gn.gn_id
              JOIN users u ON c.user_id = u.user_id
              WHERE a.agn_id = :id AND a.status = 'forwarded' ORDER BY a.created_at DESC";
        $params = ['id' => $agnid];

        return $this->query($query, $params) ?? null;
    }

    public function getSpecificApplication($application_id) {
        $query = "SELECT * 
              FROM applications
              WHERE application_id = :id";
        $params = ['id' => $application_id];

        return $this->query($query, $params) ?? null;
    }

    public function getSpecificApplicationById($application_id) {
        $query = 'SELECT * FROM applications WHERE application_id = :id';
        $params = ['id'=> $application_id];
        return $this->query($query, $params) ?? null;
    }


    public function saveApplication($data) {
        $query = "INSERT INTO applications (citizen_id, gn_id, agn_id, type, created_at, status) VALUES (:citizen_id, :gn_id, :agn_id, :type, :created_at, :status)";
        $params = [
            'citizen_id' => $data['citizen_id'],
            'gn_id' => $data['gn_id'],
            'agn_id' => $data['agn_id'],
            'type' => $data['documentType'],
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];    
        return $this->query($query, $params);
    }

    public function changeStatus($application_id, $status) {
        $query = "UPDATE applications 
              SET status = :status
              WHERE application_id = :id";

        $params = [
            'status' => $status,
            'id' => $application_id
        ];

        return $this->query($query, $params);
    }

    public function handleAction($application_id, $action, $remarks) {
        $query = "UPDATE applications 
              SET status = :status, agnremarks = :remarks
              WHERE application_id = :id";

        $params = [
            'status' => $action,
            'remarks' => $remarks,
            'id' => $application_id
        ];

        return $this->query($query, $params);
    }

    public function getLastApplication() {
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC LIMIT 1";
        return $this->query($query)[0] ?? null;
    }

}
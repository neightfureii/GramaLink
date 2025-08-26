<?php

class RuleModel {
    use Model;

    protected $table = 'rule_and_regulations'; // Specify your table name
    protected $allowedColumns = [
        'id',
        'title', 
        'description',
        'created_at',
        'updated_at',
        'status',
        'file_path'
    ];

    public function getAll($user_role) {
        if($user_role === 'agn' || $user_role === 'gn') {
            $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
            return $this->query($sql);
        } else if($user_role === 'citizen') {
            $sql = "SELECT * FROM {$this->table} WHERE status = 'Active' AND viewRole = 'citizen' ORDER BY created_at DESC";
            return $this->query($sql);
        }
    }

    
    public function addNewRule($data) {
        $sql = "INSERT INTO {$this->table} (title, description, status) VALUES (:title, :description, :status)";
        $params = [
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status']
        ];
        return $this->query($sql, $params);
    }

    // public function getAll() {
    //     $sql = "SELECT * FROM {$this->table}  WHERE status='active' ORDER BY created_at DESC";
    //     return $this->query($sql);
    // }

    public function updateRule($data) {
        $sql = "UPDATE {$this->table} SET title = :title, description = :description, status = :status WHERE id = :id";
        $params = [
            ':id' => $data['id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status']
        ];
        return $this->query($sql, $params);
    }

    public function deleteRule($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $params = [':id' => $id];
        return $this->query($sql, $params);
    }
    public function getAnnouncementbyuserid(){
        
    }

    public function getRule($user_id){
        $query = "SELECT a.* FROM rule_and_regulations a JOIN gn g ON g.user_id = a.user_id JOIN citizen c ON c.user_id = :user_id
        WHERE c.gn_division_id = g.gn_division_id";
        $params = [':user_id' => $user_id];
        return $this->query($query, $params);
    }
}

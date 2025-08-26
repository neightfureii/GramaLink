<?php

class Vote{

    use Model;

    protected $table = 'election';

    protected $allowedColumns = [
        'voting_method',
        'nic_number',
        'head_of_house',
        'relationship',
        'duration_of_residence',
        'document_proof',
        'status',
        'submitted_at'
    ];

    // public function __construct() {
    //     // Initialize database connection
    //     $this->db = new Database();
    // }

    public function getAllVoters(){
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
    

    public function find($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function getLastId() {
        $query = "SELECT id FROM $this->table ORDER BY submitted_at DESC LIMIT 1";
        $result = $this->query($query);
        return $result ? $result[0]->id : null;
    }

    // public function updateVote($data, $where)
    // {
    //     $keys = array_keys($data);
    //     $query = "UPDATE $this->table SET ";
    // }

    // public function updateVote($data, $options) {
    //     // Ensure the ID is provided in the options
    //     if (!isset($options['id'])) {
    //         throw new InvalidArgumentException("ID is required for updating a vote.");
    //     }

    //     $id = $options['id'];

    //     // Prepare the SQL update statement
    //     $setClause = [];
    //     foreach ($data as $column => $value) {
    //         // Skip the ID field to prevent it from being updated
    //         if ($column !== 'id') {
    //             $setClause[] = "$column = :$column"; // Prepare for named parameters
    //         }
    //     }
    //     $setClauseString = implode(", ", $setClause);
        
    //     $query = "UPDATE election SET $setClauseString WHERE id = :id"; 
    //     $stmt = $this->db->prepare($query);
        
    //     // Bind parameters
    //     foreach ($data as $column => $value) {
    //         // Bind only if it's not the ID
    //         if ($column !== 'id') {
    //             $stmt->bindValue(":$column", $value);
    //         }
    //     }
    //     $stmt->bindValue(":id", $id, PDO::PARAM_INT); // Bind the ID as an integer
        
    //     return $stmt->execute(); // Returns true on success
    // }


    // public function updateVote($data, $options) {
    //     if (!isset($options['id'])) {
    //         throw new InvalidArgumentException("ID is required for updating a vote.");
    //     }
    
    //     $id = $options['id'];
    //     $setClause = [];
    //     $params = [];
    
    //     foreach ($data as $column => $value) {
    //         if ($column !== 'id') {
    //             $setClause[] = "$column = :$column";
    //             $params[$column] = $value;
    //         }
    //     }
        
    //     $setClauseString = implode(", ", $setClause);
    //     $query = "UPDATE $this->table SET $setClauseString WHERE id = :id";
    //     $params['id'] = $id;
    
    //     return $this->query($query, $params);
    // }

    public function updateVote($data, $where) {
        $setClause = [];
        $params = [];
    
        foreach ($data as $column => $value) {
            $setClause[] = "$column = :$column";
            $params[$column] = $value;
        }
    
        foreach ($where as $column => $value) {
            $params[$column] = $value;
        }
        
        $setClauseString = implode(", ", $setClause);
        $whereClause = implode(" AND ", array_map(function($key) {
            return "$key = :$key";
        }, array_keys($where)));
    
        $query = "UPDATE $this->table SET $setClauseString WHERE $whereClause";
        
        return $this->query($query, $params);
    }

    public function updateStatus($nic, $status) {
        $query = "UPDATE $this->table SET status = :status WHERE nic_number = :nic";
        $params = [
            'status' => $status,
            'nic' => $nic
        ];
        return $this->query($query, $params);
    }

    // public function deleteVoter() {
    //     $today = date("Y-m-d");

    //     $query = "DELETE FROM $this->table WHERE status = 'Reject' AND DATEDIFF(:today - submitted_at) > 365 ";
    //     return $this->query($query);
    // }

    public function deleteVoter(){
        $query = "DELETE FROM $this->table WHERE status = :status";
        $params =[
            
            'status' => 'Reject'
        ];
        return $this->query($query, $params);
    }

    // public function searchByNIC($nic){
    //     $nic = "%$nic%"; // Add wildcards for partial matching
    //     $query = "SELECT * FROM $this->table WHERE nic_number LIKE :nic";
    //     $params = [
    //         'nic' => $nic
    //     ];
    //     return $this->query($query, $params);
    // }


    public function getVoterStatus($status) {
        $query = "SELECT * FROM $this->table WHERE status = :status";
        $params = [
            'status' => $status
        ];
        return $this->query($query, $params);
    }

    public function getVoterByNIC($nic) {
        $query = "SELECT * FROM $this->table WHERE nic_number = :nic";
        $params = [
            'nic' => $nic
        ];
        return $this->query($query, $params)[0] ?? null;
    }



}

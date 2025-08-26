<?php

class ElectionDate{

    use Model;

    protected $table = 'election_dates';

    protected $allowedColumns = [
        'election_date',
        'election_type',
        'created_at',
        'updated_at'
    ];

    public function getNextElection() {
         $query = "SELECT * FROM $this->table WHERE election_date >= CURDATE() ORDER BY election_date ASC LIMIT 1";
        // $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1"; // get last update in the table
        $result = $this->query($query);
        return $result;
    }
    
}
<?php 

class PollingCenter{

    use Model;

    protected $table = 'polling_centers';

    protected $allowedColumns = [
        'name',
        'address',
        'contact'
    ];

    public function getAllPollingCenters(){
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

     //searchbycenterName for searching bar
     public function searchByName($name){
        $name = "%$name%"; // Add wildcards for partial matching
        $query = "SELECT * FROM $this->table WHERE name LIKE :name";
        $params = [
            'name' => $name
        ];
        return $this->query($query, $params);
    }

    //search by name for error message
    public function getPollingCenterByName($name)
    {
        $query = "SELECT * FROM $this->table WHERE name = :name";
        $params = [
            'name' => $name
        ];
        return $this->query($query, $params);
    }
}
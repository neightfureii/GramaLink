<?php

class Citizen {
    use Model;

    protected $table = 'citizen';

    public $errors = [];

    protected $allowedColumns = ['citizen_id', 'nic', 'bcnumber', 'full_name', 'address', 'date_of_birth', 'gender', 'civil_status', 'gn_division_id', 'created_at'];

    // Retrieve citizen details
    public function getDetails($citizen_id) {
        $details = $this->where(['citizen_id' => $citizen_id]);
        return $details;
    }

    public function citizenByCitizenid($citizen_id) {
        $sql = "SELECT * 
        FROM citizen 
        JOIN users ON users.user_id = citizen.user_id
        JOIN gndivisions ON gndivisions.gn_division_id = citizen.gn_division_id
        WHERE citizen.citizen_id = :citizen_id";
        $params = ['citizen_id' => $citizen_id];

        return $this->query($sql, $params)[0] ?? null;
    }

    public function getCitizenID($user_id) {
        $sql = "SELECT * FROM citizen WHERE user_id = :id";
        $params = ['id' => $user_id];

        return $this->query($sql, $params)[0] ?? null;
    }

    public function getGnID($citizen_id) {
        $sql = "SELECT gn.gn_id FROM citizen JOIN gn ON gn.gn_division_id = citizen.gn_division_id WHERE citizen.citizen_id = :id";
        $params = ['id' => $citizen_id];

        return $this->query($sql, $params)[0] ?? null;
    }


    public function getCitizensByDivision($gndivision) {
        $sql = "SELECT * FROM $this->table JOIN users ON users.user_id = citizen.user_id WHERE gn_division_id = :gn_division_id";
        $params = ['gn_division_id' => $gndivision];

        return $this->query($sql, $params);
    }

    public function getCitizensByAGN($agnid) {
        $sql = "SELECT * 
        FROM $this->table 
        JOIN users ON users.user_id = citizen.user_id 
        JOIN gndivisions ON gndivisions.gn_division_id = citizen.gn_division_id
        WHERE citizen.gn_division_id IN (SELECT gn_division_id FROM gn WHERE agn_id = :agnid) AND age < 18"; //code check eddited part task 2(get ages below 18)
        $params = ['agnid' => $agnid];

        return $this->query($sql, $params);
    }

    public function getCitizenByNIC($nic) {
        $sql = "SELECT * FROM $this->table WHERE nic = :nic";
        $params = ['nic' => $nic];

        return $this->query($sql, $params)[0] ?? null;
    }


    // code check eddited part task 1(added age)
    public function saveCitizen($data) {
        $sql = "INSERT INTO $this->table (user_id, nic, bcnumber, full_name, address, date_of_birth, age, gender, civil_status, gn_division_id) VALUES (:user_id, :nic, :bcnumber, :full_name, :address, :date_of_birth, :age, :gender, :civil_status, :gn_division_id)";
        $params = [
            ':user_id' => $data['user_id'],
            ':nic' => $data['citizenNIC'],
            ':bcnumber' => $data['citizenBCN'],
            ':full_name' => $data['citizenName'],
            ':address' => $data['citizenAddress'],
            ':date_of_birth' => $data['citizenDOB'],
            ':age' => $data['citizenAge'],
            ':gender' => $data['citizenGender'],
            ':civil_status' => $data['citizenCivilStatus'],
            ':gn_division_id' => $data['gndivisionid']
        ];

        return $this->query($sql, $params);
    }



    public function updateCitizen($data) {
        $sql = "UPDATE $this->table SET bcnumber = :bcnumber, address = :address, date_of_birth = :date_of_birth, civil_status = :civil_status WHERE nic = :nic";
        $params = [
            ':nic' => $data['nic'],
            ':bcnumber' => $data['bcnumber'],
            ':address' => $data['address'],
            ':civil_status' => $data['civil_status'],
            ':date_of_birth' => $data['date_of_birth']
        ];
        return $this->query($sql, $params);
    }

    public function updateCitizenFromRequest($data) {
        if ($data->civil_status != null) {
            $sql = "UPDATE $this->table SET civil_status = :civil_status WHERE citizen_id = :citizen_id";
            $params[':civil_status'] = $data->civil_status;
        } else if ($data->address != null) {
            $sql = "UPDATE $this->table SET address = :address WHERE citizen_id = :citizen_id";
            $params[':address'] = $data->address;
        }
        $params[':citizen_id'] = $data->citizen_id;
        return $this->query($sql, $params);
    }


    public function getByUserId($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id LIMIT 1";
        $params = ['user_id' => $user_id];
        $result = $this->query($query, $params);
        
        if($result && count($result) > 0) {
            return $result[0]; // Return the first row as an object
        }

        
        
        return false;
    }

    public function getmalecount($gn_division_id) {
        $query = "SELECT COUNT(*) AS malecount FROM $this->table WHERE gn_division_id = :gn_division_id AND gender = 'male'";
        $params = ['gn_division_id' => $gn_division_id];
        return $this->query($query, $params)[0] ?? 0;
    }

    public function getfemalecount($gn_division_id) {
        $query = "SELECT COUNT(*) AS femalecount FROM $this->table WHERE gn_division_id = :gn_division_id AND gender='female'";
        $params = ['gn_division_id' => $gn_division_id];
        return $this->query($query, $params)[0] ?? 0;
    }
}

<?php

class GramaNiladhari {
    use Model;

    protected $table = 'gn';

    public $errors = [];


    protected $allowedColumns = [
        'gn_id',
        'user_id',
        'employee_id',
        'full_name',
        'appointed_date',
        'agn_id',
        'gn_division_id',
        'contact_office',
        'is_active',
        'created_at'

    ];


    // public function getGN($citizen_id) {
    //     $sql = "SELECT gn.gn_id FROM gn JOIN citizen ON gn.gn_division_id = citizen.gn_division_id where citizen.citizen_id = $citizen_id";
    //     $this->query($sql)[0];

    //     return false;
    // }
    public function getGNAGN($citizen_id) {
        $sql = "SELECT gn.gn_id, gn.agn_id, gn.user_id 
                FROM gn 
                JOIN citizen ON gn.gn_division_id = citizen.gn_division_id 
                WHERE citizen.citizen_id = :citizen_id";
    
        $result = $this->query($sql, ['citizen_id' => $citizen_id]);
    
        if ($result && count($result) > 0) {
            return $result[0];
        }
    
        return false;
    }


    public function getGNByAGN($agnid) {
        $query = "SELECT gn.*, u.mobileNumber, u.image, u.email, g.* 
        FROM $this->table 
        JOIN users u ON u.user_id = gn.user_id 
        JOIN gndivisions g ON g.gn_division_id = gn.gn_division_id 
        WHERE gn.agn_id = :agnid";
        
        $params = [':agnid' => $agnid];

        return $this->query($query, $params);
    }

    public function getUserByGN($gnid) {
        $query = "SELECT *
        FROM $this->table 
        WHERE gn_id = :gnid";
        
        $params = [':gnid' => $gnid];

        return $this->query($query, $params)[0]->user_id ?? null;
    }

    public function addNewGN($data) {
        $query = "INSERT INTO $this->table (user_id, employee_id, full_name, appointed_date, nic, address, agn_id, gn_division_id) VALUES (:user_id, :employee_id, :full_name, :appointed_date, :nic, :address, :agn_id, :gn_division_id)";
        $params = [
            ':user_id' => $data['user_id'],
            ':employee_id' => $data['gnEmployeeIdadd'],
            ':full_name' => $data['gnNameadd'],
            ':appointed_date' => $data['gnAppointedDateadd'],
            ':nic' => $data['gnNICadd'],
            ':address' => $data['gnAddressadd'],
            ':agn_id' => $data['agn_id'],
            ':gn_division_id' => $data['gnDivisionadd']
        ];
        return $this->query($query, $params);
    }

    public function editGN($data) {
        $query = "UPDATE $this->table SET employee_id = :employee_id, full_name = :full_name, appointed_date = :appointed_date, nic = :nic, address = :address, gn_division_id = :gn_division_id WHERE gn_id = :gn_id";
        $params = [
            ':employee_id' => $data['gnEmployeeIdedit'],
            ':full_name' => $data['gnNameedit'],
            ':appointed_date' => $data['gnAppointedDateedit'],
            ':nic' => $data['gnNICedit'],
            ':address' => $data['gnAddressedit'],
            ':gn_division_id' => $data['gnDivisionedit'],
            ':gn_id' => $data['gnIdedit']
        ];
        return $this->query($query, $params);
    }

    public function deleteGN($gnid) {
        $query = "UPDATE $this->table SET is_active = 0 WHERE gn_id = :gn_id";
        $params = [':gn_id' => $gnid];
        return $this->query($query, $params);
    }

    public function updateContactDetails($user_id, $contact_office, $address) {
        $query = "UPDATE $this->table SET contact_office = :contact_office, address = :address WHERE user_id = :user_id";
        $params = [
            ':contact_office' => $contact_office,
            ':address' => $address,
            ':user_id' => $user_id
        ];
        return $this->query($query, $params);
    }

    public function getByUserId($user_id){
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id LIMIT 1";
        return $this->query($query,['user_id' => $user_id])[0] ?? null; 
    }

    public function gnbygn($gn_id) {
        $query = "SELECT * FROM $this->table JOIN users ON users.user_id = $this->table.user_id WHERE gn_id = :gn_id LIMIT 1";
        $params = [':gn_id' => $gn_id];
        $result = $this->query($query, $params);
        return $result[0] ?? null;
    }

    public function getgndivisionid($user_id) {
        $query = "SELECT gn_division_id FROM $this->table WHERE user_id = :user_id LIMIT 1";
        $params = [':user_id' => $user_id];
        return $this->query($query, $params)[0] ?? null;
    }
    
}

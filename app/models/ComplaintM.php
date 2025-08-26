<?php 

class ComplaintM{

    use Model;

    protected $table = 'complaint';

    protected $allowedColumns =[
        'complaint_id',
        'user_id',
        'phone_number',
        'time',
        'date',
        'complaint_category',
        'complaint_description',
        'status',
        'created_at',
        
    ];

    public function getByUserId($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY date DESC";
        $params = ['user_id' => $user_id];
        $result = $this->query($query, $params);
        
        if ($result && count($result) > 0) {
            return $result; // Return all rows
        }
    
        return false;
    }
    public function getComplaintById($id) {
        $query = "SELECT * FROM $this->table WHERE complaint_id = :id";
        return $this->query($query, ['id' => $id])[0] ?? null;
    }

    public function getComplaintByGnDivision($gn_division_id){
        $query = "SELECT c.*,ct.full_name AS citizen_name,ct.nic,ct.address FROM complaint c JOIN citizen ct ON c.user_id = ct.user_id
        JOIN gndivisions gd ON ct.gn_division_id = gd.gn_division_id
        WHERE ct.gn_division_id = :gn_division_id
        ORDER BY c.date DESC";

        $parms = ['gn_division_id' => $gn_division_id];
        return $this->query($query,$parms);
    }

    public function getComplaintStats()
{
    $query = "SELECT 
                gd.division_code, gd.division_name, c.gn_division_id, COUNT(*) AS total_complaints
              FROM complaint cp
              JOIN citizen c ON cp.user_id = c.user_id
              JOIN gndivisions gd ON c.gn_division_id = gd.gn_division_id
              GROUP BY c.gn_division_id";

    return $this->query($query); // Assuming your base model has a query() function
}
    

public function getpendingcomplaintCount(){
    $query = "SELECT 
                c.*, 
                ct.full_name AS citizen_name, 
                g.full_name AS gn_name,
                g.gn_id 
              FROM complaint c
              JOIN citizen ct ON c.user_id = ct.user_id
              JOIN gn g ON ct.gn_division_id = g.gn_division_id
              WHERE c.status = 'Pending'
              ORDER BY c.date DESC";
    return $this->query($query);

}
public function getcomplaintCount(){
    $query ="SELECT COUNT(*) AS total_p_complaints FROM complaint WHERE status = 'Pending'";    
    return $this->query($query);
}

public function insertImage($data) {
    $query = "INSERT INTO complaint_images (complaint_id, image_path) VALUES (:complaint_id, :image_path)";
    $stmt = $this->query($query, $data);
    // Check if rows were affected
    return $stmt && $stmt->rowCount() > 0;

        
}
    
public function insertAndGetId() {
   $query = "SELECT * FROM complaint ORDER BY complaint_id DESC LIMIT 1";
    return $this->query($query)[0] ?? null ;

}

public function getComplaintImages($complaintId) {
    $query = "SELECT image_path FROM complaint_images WHERE complaint_id = :complaint_id";
    return $this->query($query, ['complaint_id' => $complaintId]);
}
}

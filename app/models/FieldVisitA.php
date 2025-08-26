<?php 

class FieldVisitA
{
    use Model;

    protected $table = 'field_visit_request';

    protected $allowedColoumns = [
        'id',
        'complaint_id',
        'citizen_id',
        'visit_date',
        'visit_date',
        'visit_time',
        'request_status',
        'created_at',
        'updated_at',
        'gn_id',
        'note'
    ];

    public function getVisitRequestByUserId($citizen_id){
        $query = "SELECT fvr. *, c.complaint_category FROM field_visit_request fvr
                  JOIN complaint c ON fvr.complaint_id = c.complaint_id
                  WHERE fvr.citizen_id = :citizen_id
                  ORDER BY fvr.visit_date DESC, fvr.created_at DESC";
                  ;
        $params = ['citizen_id'=> $citizen_id];
        return $this->query($query,$params) ?? null;
    }

    public function getVisitStatusByComplaintId($complaint_id){
        $query = "SELECT request_status FROM field_visit_request WHERE complaint_id = :complaint_id";
        $params = ['complaint_id'=> $complaint_id];
        return $this->query($query,$params)[0] ?? null;
    }

    public function getAcceptedVisitsForToday($gn_id, $today) {
        $query = "SELECT fvr.*, c.Address FROM field_visit_request fvr 
        JOIN citizen c ON fvr.citizen_id = c.user_id WHERE fvr.gn_id = :gn_id AND fvr.visit_date = :today AND fvr.request_status = 'accepted'";
        $params = [
            'gn_id' => $gn_id,
            'today' => $today
        ];
        
        
        $result = $this->query($query, $params);
        error_log(print_r($result, true));
        return is_array($result) ? $result : [];
    }

    public function deleteVisit($id)
    {
        
        $query = "DELETE FROM field_visit_request WHERE id=:id";
        $params = ['id' => $id];

        $stmt = $this->query($query, $params);
        return $stmt !== false;

    }

    public function insertvisit($data){
        $query = "INSERT INTO field_visits (address,gn_id) VALUES (:address, :gn_id)";
        $params = [
            'address' => $data['address'],
            'gn_id' => $data['gn_id']
        ];
        $stmt = $this->query($query, $params);

    // Check if rows were affected
        return $stmt && $stmt->rowCount() > 0;
        
    }

    public function getvisitaddress($gn_id,$today){
        $query = "SELECT *FROM field_visits WHERE gn_id = :gn_id AND created_at = :today";
        $params = [
            'gn_id' => $gn_id,
            'today' => $today
        ];
       
        return $this->query($query, $params) ?? null;
    }

    public function deletemanualvisit($id){
        $query = "DELETE FROM field_visits WHERE id = :id";
        $params = [
            'id' => $id
        ];
        return $this->query($query, $params) ?? null;
    }
    
}

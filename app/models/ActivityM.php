<?php 

class ActivityM
{
    use Model;

    protected $table = 'activity_log';

    protected $allowedColumns = [
        'id',
        'user_id',
        'action_type',
        'action_des',
        'timestamp',
    ];

    public function getTodayActivity($gn_id): array|bool {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id AND DATE(timestamp) = CURDATE() ORDER BY timestamp ASC";
        $params = [':user_id' => $gn_id];
        return $this->query($query, $params);
    }

    public function getActivityLog($gn_division,$date){
        $query = "SELECT a.* FROM activity_log a JOIN gn g ON g.user_id = a.user_id JOIN gndivisions gd ON g.gn_division_id = gd.gn_division_id 
        WHERE gd.division_code = :gn_division AND DATE(a.timestamp) = :date ORDER BY a.timestamp ASC";
        $params = [
            ':gn_division' => $gn_division,
            ':date' => $date
        ];
        return $this->query($query, $params);
    }

    
}

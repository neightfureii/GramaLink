<?php

class NotificationModel {
    use Model;

    protected $table = 'notifications';

    public function getNotificationsByUserId($user_id) {
        $query = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
        $params = [':user_id' => $user_id];
        return $this->query($query, $params);
    }

    public function newAppointment($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => $data['service_type'],
            ':message' => 'You have a new appointment scheduled on ' . $data['preferred_date'] . ' at ' . $data['preferred_time'],
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function appointmentStatusUpdate($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => $data['status']=='Completed' ? 'Appointment Completed' : 'Appointment Rejected',
            ':message' => $data['status']=='Completed' ? 'Your appointment scheduled on ' . $data['preferred_date'] . ' at ' . $data['preferred_time'] . ' was completed.' : 'Your appointment scheduled on ' . $data['preferred_date'] . ' at ' . $data['preferred_time'] . ' was rejected.',
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }    

    public function applicationStatusUpdate($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => $data['status']=='approve' ? 'Application Approved.' : ($data['status']=='reject'?'Application Rejected':'Application Forwarded to AGN'),
            ':message' => 'Your application of ID: ' . $data['applicationid'] . ' was ' . ($data['status']=='approve'?'Approved':($data['status']=='reject'?'Rejected':'Forwarded to AGN')),
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function permitStatusUpdate($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => $data['status']=='approve' ? 'Permit Approved.' : ($data['status']=='reject'?'Permit Rejected':'permit Forwarded to AGN'),
            ':message' => 'Your permit of ID: ' . $data['permitid'] . ' was ' . ($data['status']=='approve'?'Approved':($data['status']=='reject'?'Rejected':'Forwarded to AGN')),
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function applicationHandledAGN($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => $data['status']=='approved' ? 'Application Approved.' : ($data['status']=='rejected'?'Application Rejected':'Application Forwarded to AGN'),
            ':message' => 'Your application of ID: ' . $data['applicationid'] . ' was ' . ($data['status']=='approved'?'Approved':($data['status']=='rejected'?'Rejected':'Forwarded to AGN')),
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function forwardApplicationToAGN($applicationid, $to, $gnid) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $to,
            ':title' => 'Application Forwarded',
            ':message' => 'Application of ID: ' . $applicationid . ' was forwarded by ' . $gnid,
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }
    public function forwardPermitToAGN($permitid, $to, $gnid) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $to,
            ':title' => 'Permit Forwarded',
            ':message' => 'Permit of ID: ' . $permitid . ' was forwarded by ' . $gnid,
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function citizenRequest($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => 'Citizen Detail Edit Request',
            ':message' => 'Citizen of ID: ' . $data['citizen_id'] . ' sent a detail edit request.',
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }

    public function gnRequest($data) {
        $query = "INSERT INTO notifications (user_id, title, message, created_by, created_at) VALUES (:user_id, :title, :message, :created_by, :created_at)";
        $params = [
            ':user_id' => $data['to'],
            ':title' => 'GN Detail Edit Request',
            ':message' => 'GN of ID: ' . $data['gn_id'] . ' sent a detail edit request.',
            ':created_by' => $_SESSION['user_id'],
            ':created_at' => date('Y-m-d H:i:s')
        ];
        return $this->query($query, $params);
    }
    
}
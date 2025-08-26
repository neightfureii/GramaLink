<?php

class Complaint
{
    use Controller;
    
    public function index()
    {

        $data=[];

        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }


        //Get gn division number of logged in gn officer
        $user_id = $_SESSION['user_id'];
        $gnModel = new GramaNiladhari();
        $gnInfo = $gnModel->getByUserId($user_id);
        $complaintModel = new ComplaintM();
        $complaints = $complaintModel->getComplaintByGnDivision($gnInfo->gn_division_id);
        
        if ($complaints) {
            $visitModel = new FieldVisitA();
                foreach ($complaints as $complaint) {
                    $visitStatus = $visitModel->getVisitStatusByComplaintId($complaint->complaint_id);
                    if ($visitStatus) {
                        $complaint->visit_status = $visitStatus->request_status;
                    } else {
                        $complaint->visit_status = 'No Visit Request';
                    }
                }
            unset($complaint);
        }

        $data = [
            'complaints' => $complaints,
        ];
        // echo '<prev>';
        // print_r($data);
        // echo '</prev>';
        // exit;
        
        $this->view('gn/Complaint',$data);
    }

    

    public function resolve(){
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id'])){
            echo json_encode(['success' => false, 'message' => 'Complaint ID is required']);
            return;
        }

        $complaintId = $data['id'];
        $complaintModel = new ComplaintM();
        $citizenModel = new Citizen();
        $complaint = $complaintModel->getComplaintById($complaintId);
        if (!$complaint) {
            echo json_encode(['success' => false, 'message' => 'Complaint not found']);
            return;
        }
        error_log("Updating complaint ID: $complaintId");
        $result = $complaintModel->update($complaintId, ['status' => 'Resolved'], 'complaint_id');
        //frtch citizen details
        $citizen = $citizenModel->getCitizenID($complaint->user_id);
        $citizenName = $citizen ? $citizen->full_name : 'Unknown';
        if($result){
            // update log action
            $activityModel = new ActivityM();
            $formData =[
                'user_id' => $_SESSION['user_id'],
                'action_type' => 'Complaint Resolved ',
                'action_des' => 'Complaint ID: '.$complaintId . 'submitted by : ' . $citizenName,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
           $resultA= $activityModel->insert($formData);
            if(!$resultA){
                echo json_encode(['success' => false, 'message' => 'Failed to log activity']);
                return;
            }
            
            echo json_encode(['success' => true, 'message' => 'Complaint marked as resolved']);
        }else{

            echo json_encode(['success' => false, 'message' => 'Failed to mark complaint as resolved']);
        }
    }

    public function reject(){
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id'])){
            echo json_encode(['success' => false, 'message' => 'Complaint ID is required']);
            return;
        }

        $complaintId = $data['id'];
        $complaintModel = new ComplaintM();
        $citizenModel = new Citizen();
        $complaint = $complaintModel->getComplaintById($complaintId);
        if (!$complaint) {
            echo json_encode(['success' => false, 'message' => 'Complaint not found']);
            return;
        }
        error_log("Updating complaint ID: $complaintId");
        $result = $complaintModel->update($complaintId, ['status' => 'Rejected'], 'complaint_id');
        //get citizen details
        $citizen = $citizenModel->getCitizenID($complaint->user_id);
        $citizenName = $citizen ? $citizen->full_name : 'Unknown';
        if($result){
            // Update log table 

            $activityModel = new ActivityM();
            $formData =[
                'user_id' => $_SESSION['user_id'],
                'action_type' => 'Complaint Rejected',
                'action_des' => 'Complaint ID: '.$complaintId . 'submitted by : ' . $citizenName,
                'timestamp' => date('Y-m-d H:i:s')
            ];
           $resultA= $activityModel->insert($formData);
            if(!$resultA){
                echo json_encode(['success' => false, 'message' => 'Failed to log activity']);
                return;
            }
            echo json_encode(['success' => true, 'message' => 'Complaint marked as resolved']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Failed to mark complaint as resolved']);
        }
    }
    public function getComplaintImages($complaintId)
{
    $complaintImageModel = new ComplaintM(); // Assume this model accesses complain_images table
    $images = $complaintImageModel->getComplaintImages($complaintId);

    if ($images) {
        echo json_encode(['success' => true, 'images' => $images]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No images found']);
    }
}



}

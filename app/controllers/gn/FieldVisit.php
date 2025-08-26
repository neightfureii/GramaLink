<?php

class FieldVisit
{
    use Controller;
    
    public function index()
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
            exit;

        }

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $complaint_id = $_GET['complaint_id'] ?? null;
        
        $data = $this->getComplaintAndCitizen($complaint_id);
        date_default_timezone_set('Asia/Colombo'); // or your desired timezone
        $today = date('Y-m-d');
        

        $gn_id = $_SESSION['user_id'];
        $visitModel = new FieldVisitA();
        try{

            $todayVisit = $visitModel->getAcceptedVisitsForToday($gn_id, $today);
            $address = $visitModel->getvisitaddress($gn_id, $today);
        }catch(Exception $e){
            error_log($e->getMessage());
            $todayVisit = [];   
            $_SESSION['error_message'] = "Could not load today's visits. Please try again later.";
        }
        if(!empty($address)){
            foreach($address as $addr){
                $todayVisit[] = [
                    'idnamual' => $addr->id,
                    'Address' => $addr->address,
                    'visit_date' => $today,
                    'gn_id' => $gn_id,
                    
                ];
            }        
        }
        
        
        $data['todayVisit'] = $todayVisit;
        // echo '<pre>';
        // print_r($todayVisit);
        // echo '</pre>';
        // exit();
        $this->view('gn/FieldVisit',$data);
    }

    public function addRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $complaint_id = $_POST['complaint_id'] ?? null;
            $visit_date = $_POST['visit_date'] ?? null;
            $visit_time = $_POST['visit_time'] ?? null;
            $note = $_POST['note'] ?? null;
            $gn_id = $_SESSION['user_id'];
    
            $complaintModel = new ComplaintM();
            $complaint = $complaintModel->getComplaintById($complaint_id);
            $citizen_id = $complaint->user_id ?? null;
    
            try {
                if(!$citizen_id){
                    $_SESSION['error_message'] = 'Failed to submit  field visit request.';
                    header('Location: ' . ROOT . '/gn/FieldVisit');
                    exit;
                }
                $formData = [
                    'complaint_id' => $complaint_id,
                    'visit_date' => $visit_date,
                    'visit_time' => $visit_time,
                    'note' => $note,
                    'gn_id' => $gn_id,
                    'citizen_id' => $citizen_id,
                ];
    
                $fieldVisitModel = new FieldVisitA();
                $result = $fieldVisitModel->insert($formData);
    
                if ($result) {
                    // update log table
                    $activityModel = new ActivityM();
                    $formDataA = [
                        'user_id' => $_SESSION['user_id'],
                        'action_type' => 'Field Visit Request',
                        'action_des' => 'Field visit request submitted for complaint ID: ' . $complaint_id . 'related to : '. $complaint->complaint_category,
                        'timestamp' => date('Y-m-d H:i:s')
                    ];
                    $activityModel->insert($formDataA);
                    
                    $_SESSION['success_message'] = 'Field visit request submitted successfully!';
                    unset($_SESSION['error_message']);
                } else {
                    $_SESSION['error_message'] = 'Failed to submit field visit request.';
                    unset($_SESSION['success_message']);
                }
    
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error: Could not submit field visit request.";
                unset($_SESSION['success_message']);
            }
    
            header('Location: ' . ROOT . '/gn/FieldVisit');
            exit;
        }
    }
    

    private function getComplaintAndCitizen($complaint_id)
    {
        $complaint = null;
        $citizen = null;

        if ($complaint_id) {
            $complaintModel = new ComplaintM();
            $complaint = $complaintModel->getComplaintById($complaint_id);
        
        
            if($complaint && isset($complaint->user_id)){
                $citizenModel = new Citizen();
                $userModel = new User();
                $citizen = $citizenModel->getByUserId($complaint->user_id);
                $phone_number = $userModel->getPhoneNumberByUserId($complaint->user_id);
                if (!$phone_number) {
                    $phone_number = (object) ['mobileNumber' => null]; // Default to avoid warnings
                }
            }
            if (!$complaint) {
                die("Complaint not found.");
            }
        }
        return[
            'complaint' => $complaint,
            'citizen' => $citizen,
            'complaint_id' => $complaint_id,
            'phone_number' => $phone_number ?? null,

        ];

    }

    public function deletevisit($id){
        header('Content-Type: application/json');
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $visitModel = new FieldVisitA();
            $data = json_decode(file_get_contents('php://input'), true);
            $complaint_id = $data['complaint_id'];
            

            if($complaint_id){
                $complaintModel = new ComplaintM();
                $complaintModel->update($complaint_id,['status' => 'Resolved'], 'complaint_id');
            }
            $result = $visitModel->delete($id);
            
            if($result){
                echo json_encode(['status' => 'success']);
            }else{
          
                echo json_encode(['status' => 'error', 'message' => 'failed to delete visit']);

            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);

        }
        exit;
    }

    public function deletemanualvisit($id){
        header('Content-Type: application/json');
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $visitModel = new FieldVisitA();
            
            $result = $visitModel->deletemanualvisit($id);
            
            if($result){
                echo json_encode(['status' => 'success']);
            }else{
                echo json_encode(['status' => 'error', 'message' => 'failed to delete visit']);
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
        exit;
    }

    public function addManualVisit(){
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $formData = [
                'address' => $_POST['address'],
                'gn_id' => $_SESSION['user_id'],
            ];
            $visitModel = new FieldVisitA();
            $result = $visitModel->insertvisit($formData);
            if($result){
                $_SESSION['success_message'] = 'Field visit added successfully!';
                unset($_SESSION['error_message']);
            }else{
                $_SESSION['error_message'] = 'Failed to add field visit.';
                unset($_SESSION['success_message']);
            }
            header('Location: ' . ROOT . '/gn/FieldVisit');
        }
    }
}

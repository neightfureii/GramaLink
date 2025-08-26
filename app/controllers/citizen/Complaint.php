<?php

class Complaint
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
            exit;
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
            exit;
        }
        //define array to store details
        $citizenData = [];
        $complainDetails = [];

        //get citizen details
        $citizenModel = new Citizen();
        $citizenData = $citizenModel->getByUserId($_SESSION['user_id']);

        //get user Email
        $userModel = new User();
        $user = $userModel->getCitizenById($_SESSION['user_id']);

        $complaintModel = new ComplaintM();
        //check request method and get front data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check phone number 
            if (!$complaintModel->validatePhone($_POST['phone'])) {
                $_SESSION['error_message'] = "Invalid phone number format.";
                header('Location: ' . ROOT . '/citizen/Complaint'); // Redirect back with error
                exit;  
            }
            $formData = [
                'user_id' => $_SESSION['user_id'],
                'phone_number' => $_POST['phone'],
                'time' => $_POST['time'],
                'date' => $_POST['date'],
                'complaint_category' => $_POST['complaintCategory'],
                'complaint_description' => $_POST['text'],
                'status' => 'Pending'
            ];
            //insert complaint details 
            $result1 = $complaintModel->insert($formData); 
            //get complaint id
            $complaint = $complaintModel->insertAndGetId();
            $complaintId = $complaint->complaint_id;
            
            // Handle multiple file uploads
            if (!empty($_FILES['image']['name'][0])) {
                $total = count($_FILES['image']['name']);
                $uploadDir = __DIR__ . '/../../../public/uploads/complaints';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    for ($i = 0; $i < $total; $i++) {
                        if ($_FILES['image']['error'][$i] == UPLOAD_ERR_OK) {
                            $fileTmpPath = $_FILES['image']['tmp_name'][$i];
                            $fileName = $_FILES['image']['name'][$i];
                            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                            $newFileName = uniqid('complaint_') . '.' . $fileExtension;
                            $destPath = $uploadDir . '/' . $newFileName;
                            if (move_uploaded_file($fileTmpPath, $destPath)) {
                                $imagePath = 'uploads/complaints/' . $newFileName;
                    
                                // Store image path in complaint_image table
                                $result2 = $complaintModel->insertImage([
                                    'complaint_id' => $complaintId,
                                    'image_path' => $imagePath
                                ]);
                            }
        
                        }
                    }
            }
            if($result1){
                $_SESSION['success_message'] = "Complaint Submition Successfull";
                header('Location: ' . ROOT . '/citizen/Complaint');
                exit;
            }else{
                $_SESSION['error_message'] = "Complaint Submition Faile";
                header('Location: ' . ROOT . '/citizen/Complaint'); // Redirect back with error
                exit; 
            }
        
                
        }
        //get complaint details to view
                    
        $complainDetails = $complaintModel->getByUserId($_SESSION['user_id']);
        $data =[
            'citizenData' => $citizenData,
            'complainDetails' => $complainDetails,
            'user' => $user,
        ];
        //get citizen details to the complain view 
        $this->view('citizen/Complaint',$data);
    }
    public function getComplaintDetails($id) {
        try{
            $complaintModel = new ComplaintM();

        
            $complaint = $complaintModel->getComplaintById($id);
            $images = $complaintModel->getComplaintImages($id);
           
            if ($complaint) {
                echo json_encode(['success' => true, 'complaint' => $complaint, 'images' => $images]);
            } else {
                echo json_encode(['success' => false]);
            }
        }catch(Exception $e){
            echo json_encode(['success' => false, 'message' => 'An unexpected error occurred. Please try again later.']);
        }
       
    }
       
        
        
    


}

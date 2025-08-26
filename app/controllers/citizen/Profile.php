<?php
class Profile
{
    use Controller;
    public function index()
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $userModel = new User();
        $userDetails = $userModel->getUserById($_SESSION['user_id']);

        $this->view('citizen/Profile', ['userDetails' => $userDetails]);
    }

    public function submitEditRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $editRequestModel = new EditRequest();
            $citizenModel = new Citizen();
            $notificationModel = new NotificationModel();
            $gnModel = new GramaNiladhari();

            $citizenDetails = $citizenModel->getCitizenID($_SESSION['user_id']);
            $_POST['citizen_id'] = $citizenDetails->citizen_id;
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    
                if (in_array($fileExtension, $allowedfileExtensions)) {
                    $newFileName = uniqid() . '.' . $fileExtension;
                    $uploadFileDir = 'assets/images/profileImages/profileImageRequests/';
                    $dest_path = $uploadFileDir . $newFileName;
    
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0777, true);
                    }
    
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $_POST['image'] = $dest_path;
                    } else {
                        $_SESSION['flash_message_reject'] = 'Error moving the uploaded file.';
                        header('Location:'.ROOT.'/citizen/profile');
                        exit;
                    }
                } else {
                    $_SESSION['flash_message_reject'] = 'Unsupported file type. Allowed types: jpg, jpeg, png, pdf.';
                    header('Location:'.ROOT.'/citizen/profile');
                    exit;
                }
            }
            
            $result = $editRequestModel->newPersonalRequest($_POST);
            if ($result) {
                $_SESSION['flash_message_complete'] = 'Your request has been submitted successfully!';
                $data['to'] = $gnModel->getGNAGN($_POST['citizen_id'])->user_id;
                $data['citizen_id'] = $_POST['citizen_id'];
                $notificationModel->citizenRequest($data);
            } else {
                $_SESSION['flash_message_reject'] = 'There was an error submitting your request. Please try again.';
            }            
    
            header('Location:'.ROOT.'/citizen/profile');
        } else {
            header('Location:'.ROOT.'/citizen/profile');
        }
    }
    
}

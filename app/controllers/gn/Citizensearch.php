<?php

class Citizensearch
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
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $userModel = new User();
        $gnDetails = $userModel->getGNById($_SESSION['user_id']);

        $citizenModel = new Citizen();
        $citizens = $citizenModel->getCitizensByDivision($gnDetails->gn_division_id);
        
        $editRequestModel = new EditRequest();
        $allEditRequests = [];
        if (!empty($citizens)) {
            foreach ($citizens as $citizen) {
                $editRequests = $editRequestModel->getRequestsByCitizen($citizen->citizen_id);
                if (!empty($editRequests)) {
                    $allEditRequests = array_merge($allEditRequests, $editRequests);
                }
            }
        }
        
        $this->view('gn/Citizensearch', ['citizens' => $citizens, 'requests' => $allEditRequests]);
    }

    public function addNewCitizen() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $citizenModel = new Citizen();
            $userModel = new User();

            $existingCitizen = $citizenModel->getCitizenByNIC($_POST['citizenNIC']);
            if ($existingCitizen) {
                $_SESSION['flash_message_reject'] = "Citizen with this NIC already exists.";
                header('Location:'.ROOT.'/gn/citizensearch');
            } else {
                $_POST['imagePath'] = null;
                if (isset($_FILES['citizenPhoto']) && $_FILES['citizenPhoto']['error'] === UPLOAD_ERR_OK) {
                    $fileTmp = $_FILES['citizenPhoto']['tmp_name'];
                    $fileName = basename($_FILES['citizenPhoto']['name']);
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                    if (in_array($fileExt, $allowedExts)) {
                        $newFileName = 'profile_' . $_POST['citizenNIC'] . '_' . time() . '.' . $fileExt;
                        $uploadDir = 'assets/images/profileImages/';
                        $uploadPath = $uploadDir . $newFileName;

                        if (move_uploaded_file($fileTmp, $uploadPath)) {
                            $_POST['imagePath'] = '/' . $uploadPath;
                        }
                    }
                }

                // code check editted part task 1 (validation)
                if($_POST['citizenAge'] < 0) {
                    $_SESSION['flash_message_reject'] = "Invalid age entered(Negative Value)!";
                    header('Location:'.ROOT.'/gn/citizensearch');
                    exit;
                }

                $userModel -> addNewCitizenUser($_POST);

                $_POST['user_id'] = $userModel->getUserIDLastCitizen();
                $_POST['gndivisionid'] = $userModel->getGNById($_SESSION['user_id'])->gn_division_id;

                $citizenModel -> saveCitizen($_POST);

                $_SESSION['flash_message_complete'] = "Citizen added successfully!";

                header('Location:'.ROOT.'/gn/citizensearch');
            }
        }
    }
}

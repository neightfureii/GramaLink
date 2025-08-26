<?php

class New_Permit
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->saveNewPermit();
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);

        $this->view('citizen/new_permit', ['userDetails' => $userDetails]);
    }

    public function saveNewPermit() {
        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);
        
        $_POST['citizen_id'] = $userDetails->citizen_id;

        $gnModel = new GramaNiladhari();
        $gnagn = $gnModel->getGNAGN($userDetails->citizen_id);
        $_POST['gn_id'] = $gnagn->gn_id;
        $_POST['agn_id'] = $gnagn->agn_id;
        
        $permitModel = new PermitModel();
        $permitModel->savepermit($_POST);
        
        $_POST['permit_id'] = $permitModel->getLastPermit()->permit_id;

        switch ($_POST['documentType']) {
            case 'building_construction':
                $model = new PermitConstruction();
                $model->savePermit($_POST);
                break;

            case 'small_business':
                $model = new PermitBusiness();
                $model->savePermit($_POST);
                break;

            case 'cattle_rearing':
                $model = new PermitCattle();
                $model->savePermit($_POST);
                break;
            
            case 'loudspeaker':
                $model = new PermitLoudspeaker();
                $model->savePermit($_POST);
                break;
            
            default:
                // $errors['invalidType'] = "Invalid Permit Type";
                break;
        }

        $_SESSION['flash_message'] = "Permit submitted successfully!<br/>Proceed to book an appointment.";

        // Redirect to the appointment page to set an appointment for the permit
        $_SESSION['permitDetails'] = $_POST;
        
        header('Location: ' . ROOT . '/citizen/appointment');
    }
}

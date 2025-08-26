<?php

class New_Application
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
            return $this->saveNewApplication();
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);

        $this->view('citizen/new_application', ['userDetails' => $userDetails]);
    }

    public function saveNewApplication() {
        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);
        
        $_POST['citizen_id'] = $userDetails->citizen_id;

        $gnModel = new GramaNiladhari();
        $gnDetails = $gnModel->getGNAGN($userDetails->citizen_id);
        $_POST['gn_id'] = $gnDetails->gn_id;
        $_POST['agn_id'] = $gnDetails->agn_id;

        
        $applicationModel = new ApplicationModel();
        $applicationModel->saveApplication($_POST);

        $_POST['application_id'] = $applicationModel->getLastApplication()->application_id;

        switch ($_POST['documentType']) {
            case 'residence':
                $model = new ApplicationResidence();
                $model->saveApplication($_POST); 
                break;

            case 'character':
                $model = new ApplicationCharacter();
                $model->saveApplication($_POST);
                break;

            case 'incomeCertificate':
                $model = new ApplicationIncome();
                $model->saveApplication($_POST);
                break;

            case 'publicAid':
                $model = new ApplicationPublicAid();
                $model->saveApplication($_POST); 
                break;

            case 'electricityWater':
                $model = new ApplicationEW();
                $model->saveApplication($_POST);
                break;

            case 'criminalBgCheck':
                $model = new ApplicationCBC();
                $model->saveApplication($_POST);
                break;

            case 'deathCertificate':
                $model = new ApplicationDeath();
                $model->saveApplication($_POST);
                break;

            case 'valuationCertificate':
                $model = new ApplicationValue();
                $model->saveApplication($_POST); 
                break;

            case 'idApplication':
                $model = new ApplicationId();
                $model->saveApplication($_POST);
                break;

            case 'landOwnership':
                $model = new ApplicationLandOwnership();
                $model->saveApplication($_POST);
                break;

            default:
                // $errors['invalidType'] = "Invalid Certificate Type";
                break;
        }

        $_SESSION['flash_message'] = "Application submitted successfully!<br/>Proceed to book an appointment.";

        // Redirect to the appointment page to set an appointment for the application
        $_SESSION['applicationDetails'] = $_POST;

        header('Location: ' . ROOT . '/citizen/appointment');
    }
}

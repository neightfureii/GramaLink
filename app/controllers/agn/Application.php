<?php

class Application
{
    use Controller;
    
    public function index()
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $userModel = new User();
        $user_id = $_SESSION['user_id'];
        $agndetails = $userModel->getAGNById($user_id);

        $applicationModel = new ApplicationModel();
        $applications = $applicationModel->getApplicationDetailsByAGN($agndetails->agn_id);

        $permitModel = new PermitModel();
        $permits = $permitModel->getPermitDetailsByAGN($agndetails->agn_id);

        $this->view('agn/Application', ['applications' => $applications, 'permits' => $permits]);
    }

    public function handleAction($id, $action, $remarks = '') {
        $applicationModel = new ApplicationModel();
        $notificationModel = new NotificationModel();
        $citizenModel = new Citizen();

        $application = $applicationModel->getSpecificApplicationById($id);
        $citizen = $citizenModel->citizenByCitizenid($application[0]->citizen_id);
        
        $applicationModel->handleAction($id, $action, $remarks);
        
        $data['status'] = $action;
        $data['to'] = $citizen->user_id; 
        $data['applicationid'] = $id;
        $notificationModel->applicationHandledAGN($data);

        $_SESSION['flash_message_complete'] = "Application " . $action . " Successfully!";
    
        header('Location:'.ROOT.'/agn/application');
    }

    public function fetchDetails($applicationid) {
        $applicationModel = new ApplicationModel();
        $application = $applicationModel->getSpecificApplicationById($applicationid);

        switch ($application[0]->type) {
            case 'residence':
                $model = new ApplicationResidence();
                $applicationDetails = $model->getApplicationDetails($applicationid); 
                break;

            case 'character':
                $model = new ApplicationCharacter();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'incomeCertificate':
                $model = new ApplicationIncome();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'publicAid':
                $model = new ApplicationPublicAid();
                $applicationDetails = $model->getApplicationDetails($applicationid); 
                break;

            case 'electricityWater':
                $model = new ApplicationEW();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'criminalBgCheck':
                $model = new ApplicationCBC();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'deathCertificate':
                $model = new ApplicationDeath();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'valuationCertificate':
                $model = new ApplicationValue();
                $applicationDetails = $model->getApplicationDetails($applicationid); 
                break;

            case 'idApplication':
                $model = new ApplicationId();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            case 'landOwnership':
                $model = new ApplicationLandOwnership();
                $applicationDetails = $model->getApplicationDetails($applicationid);
                break;

            default:
                // $errors['invalidType'] = "Invalid Certificate Type";
                break;
        }

        $applicationDetailsArray = (array) $applicationDetails;
        echo json_encode($applicationDetailsArray);
    }
}

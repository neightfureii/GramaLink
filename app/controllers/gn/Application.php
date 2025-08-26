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

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $userid = $_SESSION['user_id'];
        $user = new User();
        $userdetails = $user->getGNById($userid);

        $applicationModel = new ApplicationModel();
        $applicationDetails = $applicationModel->getApplicationDetailsByGN($userdetails->gn_id);

        $permitModel = new PermitModel();
        $permitDetails = $permitModel->getPermitDetailsByGN($userdetails->gn_id);

        $this->view('gn/Application', ['applicationDetails'=> $applicationDetails, 'permitDetails'=> $permitDetails]);
    }

    public function confirmAction($applicationid, $action) {
        $applicationModel = new ApplicationModel();
        $notificationModel = new NotificationModel();
        $citizenModel = new Citizen();

        $application = $applicationModel->getSpecificApplicationById($applicationid);
        $citizen = $citizenModel->citizenByCitizenid($application[0]->citizen_id);
        $data['to'] = $citizen->user_id; 
        $data['status'] = $action;
        $data['applicationid'] = $applicationid;

        if($action === 'approve') {
            $applicationModel->changeStatus($applicationid, 'approved');
            $_SESSION['flash_message_complete'] = "Application Approved!";
        } else if($action === 'reject') {
            $applicationModel->changeStatus($applicationid, 'rejected');
            $_SESSION['flash_message_complete'] = "Application Rejected!";
        } else if($action === 'forward') {
            $applicationModel->changeStatus($applicationid, 'forwarded');
            $_SESSION['flash_message_complete'] = "Application Forwarded to AGN!";
            $agnmodel = new AGNModel();
            $to = $agnmodel->getUserId($application[0]->agn_id)[0]->user_id;
            $gnid = $application[0]->gn_id;

            $notificationModel->forwardApplicationToAGN($applicationid, $to, $gnid);
        }


        $notificationModel->applicationStatusUpdate($data);

        header('Location:'.ROOT.'/gn/application');
    }

    public function confirmActionPermit($permitid, $action) {
        $permitModel = new PermitModel();
        $notificationModel = new NotificationModel();
        $citizenModel = new Citizen();

        $permit = $permitModel->getSpecificPermitById($permitid);
        $citizen = $citizenModel->citizenByCitizenid($permit[0]->citizen_id);
        $data['to'] = $citizen->user_id; 
        $data['status'] = $action;
        $data['permitid'] = $permitid;
        if($action === 'approve') {
            $permitModel->changeStatus($permitid, 'approved');
            $_SESSION['flash_message_complete'] = "Permit Approved!";
        } else if($action === 'reject') {
            $permitModel->changeStatus($permitid, 'rejected');
            $_SESSION['flash_message_complete'] = "Permit Rejected!";
        } else if($action === 'forward') {
            $permitModel->changeStatus($permitid, 'forwarded');
            $_SESSION['flash_message_complete'] = "Application Forwarded to AGN!";
            $agnmodel = new AGNModel();
            $to = $agnmodel->getUserId($permit[0]->agn_id)[0]->user_id;
            $gnid = $permit[0]->gn_id;

            $notificationModel->forwardPermitToAGN($permitid, $to, $gnid);
        }

        $notificationModel->permitStatusUpdate($data);

        header('Location:'.ROOT.'/gn/application');
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

    public function fetchPermitDetails($permitid) {
        $permitModel = new PermitModel();
        $permit = $permitModel->getSpecificPermitById($permitid);

        switch ($permit[0]->type) {
            case 'building_construction':
                $model = new PermitConstruction();
                $permitDetails = $model->getPermitDetails($permitid); 
                break;

            case 'small_business':
                $model = new PermitBusiness();
                $permitDetails = $model->getPermitDetails($permitid);
                break;

            case 'cattle_rearing':
                $model = new PermitCattle();
                $permitDetails = $model->getPermitDetails($permitid);
                break;

            case 'loudspeaker':
                $model = new PermitLoudspeaker();
                $permitDetails = $model->getPermitDetails($permitid); 
                break;

            default:
                // $errors['invalidType'] = "Invalid Permit Type";
                break;
        }

        $permitDetailsArray = (array) $permitDetails;
        echo json_encode($permitDetailsArray);
    }

}

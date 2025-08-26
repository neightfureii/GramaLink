<?php

class Permit
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

        $citizenModel = new Citizen();
        $citizenDetails = $citizenModel->getCitizenID($_SESSION['user_id']);

        $permitModel = new PermitModel();
        $permitDetails = $permitModel->getPermitDetails($citizenDetails->citizen_id);

        $this->view('citizen/Permit', ['permitDetails' => $permitDetails]);
    }
}

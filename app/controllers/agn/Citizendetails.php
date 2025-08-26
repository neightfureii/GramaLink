<?php

class Citizendetails
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

        $agnModel = new AGNModel();
        $agnDetails = $agnModel->getAGNByUserId($_SESSION['user_id']);
        
        $citizenModel = new Citizen();
        $citizenDetails = $citizenModel->getCitizensByAGN($agnDetails[0]->agn_id);

        $this->view('agn/Citizendetails', ['citizenDetails' => $citizenDetails]);
    }
}

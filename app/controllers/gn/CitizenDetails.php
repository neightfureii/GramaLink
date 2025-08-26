<?php

class CitizenDetails {
    use Controller;
    
    public function index($citizenid)
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

        $userModel = new Citizen();
        $citizen = $userModel->citizenByCitizenid($citizenid);

        $this->view('gn/CitizenDetails', ['citizen' => $citizen]);
    } 
    
    public function update_citizen_profile() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $userModel = new User();
            $citizenModel = new Citizen();
            $citizenDetails = $citizenModel->getCitizenByNIC($_POST['nic']);
            $_POST['user_id'] = $citizenDetails->user_id;

            if($citizenDetails) {
                $citizenModel->updateCitizen($_POST);
                $userModel->updateCitizen($_POST);

                header('Location:'.ROOT.'/gn/CitizenDetails/'.$citizenDetails->citizen_id);
            }
        }
    }
}

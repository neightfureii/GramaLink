<?php

class Dashboard
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
        
       

        $user_id = $_SESSION['user_id'];
        $gnModel = new GramaNiladhari();
        $gn_division = $gnModel->getgndivisionid($user_id);
        $gn_division_id = is_object($gn_division) ? $gn_division->gn_division_id : $gn_division;
        $citizenModel = new Citizen();
        $maleCount = $citizenModel->getmalecount($gn_division_id);
        $femaleCount = $citizenModel->getfemalecount($gn_division_id);

        $data = [
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount
        ];

        $this->view('gn/Dashboard', $data);
    }
}

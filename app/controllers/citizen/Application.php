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
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);

        $applicationModel = new ApplicationModel();
        $applicationDetails = $applicationModel->getApplicationDetails($userDetails->citizen_id);
        
        $this->view('citizen/Application', ['applicationDetails' => $applicationDetails]);
    }
}

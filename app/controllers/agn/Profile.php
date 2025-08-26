<?php
class Profile
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
        $user = $userModel->getAGNById($_SESSION['user_id']);

        $this->view('agn/Profile', ['user' => $user]);
    }
}

<?php

class Contact
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

        $this->view('agn/Contact', ['user' => $user]);
    }

    public function editContactDetails() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $agnModel = new AGNModel();
            $userModel = new User();

            if($userModel->updateContactDetails($_SESSION['user_id'], $_POST['email'], $_POST['mobileNumber'])) {
                if ($agnModel->editContactDetails($_POST)) {
                    $_SESSION['flash_message_complete'] = 'Details saved successfully!';
                } else {
                    $_SESSION['flash_message_reject'] = 'Error saving details. Please try again.';
                }
            } else {
                $_SESSION['flash_message_reject'] = 'Error saving details. Please try again.';
            }
    
            header('Location:'.ROOT.'/agn/contact');
        } else {
            header('Location:'.ROOT.'/agn/contact');
        }   
    }
}

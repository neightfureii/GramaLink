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

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $userModel = new User();
        $user = $userModel->getGNByIdAll($_SESSION['user_id']);

        $this->view('gn/Contact', ['user' => $user]);
    }

    public function editContactDetails() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $editRequestModel = new EditRequestGN();
            $gnModel = new GramaNiladhari();
            $notificationModel = new NotificationModel();
            $agnModel = new AGNModel();

            $gnDetails = $gnModel->getByUserId($_SESSION['user_id']);
            $_POST['gn_id'] = $gnDetails->gn_id;

            $result = $editRequestModel->newContactRequest($_POST);
            if ($result) {
                $_SESSION['flash_message_complete'] = 'Your request has been submitted successfully!';
                $data['to'] = $agnModel->getUserId($gnDetails->agn_id)[0]->user_id;
                $data['gn_id'] = $_POST['gn_id'];
                $notificationModel->gnRequest($data);
            } else {
                $_SESSION['flash_message_reject'] = 'There was an error submitting your request. Please try again.';
            }
    
            header('Location:'.ROOT.'/gn/contact');
        } else {
            header('Location:'.ROOT.'/gn/contact');
        }   
    }
}

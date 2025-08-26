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
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $userModel = new User();
        $userDetails = $userModel->getUserById($_SESSION['user_id']);

        $this->view('citizen/Contact', ['userDetails' => $userDetails]);
    }

    public function submitEditRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $editRequestModel = new EditRequest();
            $citizenModel = new Citizen();
            $notificationModel = new NotificationModel();
            $gnModel = new GramaNiladhari();

            $citizenDetails = $citizenModel->getCitizenID($_SESSION['user_id']);
            $_POST['citizen_id'] = $citizenDetails->citizen_id;

            $result = $editRequestModel->newContactRequest($_POST);
            if ($result) {
                $_SESSION['flash_message_complete'] = 'Your request has been submitted successfully!';
                $data['to'] = $gnModel->getGNAGN($_POST['citizen_id'])->user_id;
                $data['citizen_id'] = $_POST['citizen_id'];
                $notificationModel->citizenRequest($data);
            } else {
                $_SESSION['flash_message_reject'] = 'There was an error submitting your request. Please try again.';
            }
    
            header('Location:'.ROOT.'/citizen/contact');
        } else {
            header('Location:'.ROOT.'/citizen/contact');
        }
    }
}

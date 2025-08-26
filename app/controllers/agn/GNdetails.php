<?php

class GNdetails
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
        
        $gnModel = new GramaNiladhari();
        $gnDetails = $gnModel->getGNByAGN($agnDetails[0]->agn_id);

        $gndivisionsModel = new GNDivisions();
        $divisions = $gndivisionsModel->getAllDivisionsByAGN($agnDetails[0]->agn_id);

        $editRequestGNModel = new EditRequestGN();
        $requests = $editRequestGNModel->getAllRequests();

        $this->view('agn/GNdetails', ['gnDetails' => $gnDetails, 'divisions' => $divisions, 'requests' => $requests]);
    }

    public function addNewGN() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['password'] = password_hash($_POST['gnNICadd'], PASSWORD_DEFAULT);
            $userModel = new User();
            $userModel->addNewGNUser($_POST);
            $userid = $userModel->getUserIDLastGN();
            $_POST['user_id'] = $userid;

            $agnModel = new AGNModel();
            $agnDetails = $agnModel->getAGNByUserId($_SESSION['user_id']);
            $_POST['agn_id'] = $agnDetails[0]->agn_id;

            $gnModel = new GramaNiladhari();
            $gnModel->addNewGN($_POST);

            $_SESSION['flash_message_complete'] = 'New Grama Niladhari added successfully!';

            header('Location:'.ROOT.'/agn/GNdetails');
        }
    }

    public function editGN() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gnModel = new GramaNiladhari();
            $gnModel->editGN($_POST);

            header('Location:'.ROOT.'/agn/GNdetails');
        }
    }

    public function deleteGN($gnid) {
        $gnModel = new GramaNiladhari();
        $userModel = new User();
        $userid = $gnModel->getUserByGN($gnid);

        $userModel->deleteUser($userid);
        $gnModel->deleteGN($gnid);

        header('Location:'.ROOT.'/agn/GNdetails');
    }
}

<?php

class CitizenRequests {
    use Controller;
    
    public function index($reqid)
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

        $editrequestModel = new EditRequest();
        $req = $editrequestModel->getSpecificRequest($reqid);

        $userModel = new Citizen();
        $citizen = $userModel->citizenByCitizenid($req[0]->citizen_id);


        $this->view('gn/CitizenRequests', ['request' => $req[0], 'citizen' => $citizen]);
    } 
    
    public function handleRequest($id, $action) {
        $editrequestModel = new EditRequest();
        $citizenModel = new Citizen();
        $userModel = new User();
        $editrequestModel->updateRequestStatus($id, $action);
        $result = $editrequestModel->getSpecificRequest($id)[0];
        $citizenModel->updateCitizenFromRequest($result);
        $result->user_id = $citizenModel->citizenByCitizenid($result->citizen_id)->user_id;
        $userModel->updateUserFromRequest($result);
        header('Location:'.ROOT.'/gn/Citizensearch');
    }
}

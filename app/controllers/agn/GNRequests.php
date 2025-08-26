<?php

class GNRequests {
    use Controller;
    
    public function index($reqid)
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $editrequestModel = new EditRequestGN();
        $req = $editrequestModel->getSpecificRequest($reqid);
        $userModel = new GramaNiladhari();
        $gn = $userModel->gnbygn($req[0]->gn_id);

        $this->view('agn/GNRequests', ['request' => $req[0], 'gn' => $gn]);
    } 
    
    public function handleRequest($id, $action) {
        $editrequestModel = new EditRequestGN();
        $editrequestModel->updateRequestStatus($id, $action);
        header('Location:'.ROOT.'/agn/GNDetails');
    }
}

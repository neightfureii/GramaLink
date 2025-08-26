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

        if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }


        $complaintModel = new ComplaintM();
        $pendingcomplaints = $complaintModel->getcomplaintCount();


        $userModel = new User();
        $userDetails = $userModel->getAGNById($_SESSION['user_id']);

        $applicationModel = new ApplicationModel();
        $applications = $applicationModel->getApplicationDetailsByAGN($userDetails->agn_id);

        if($applications) {
            $applicationCount = count($applications);
        } else {
            $applicationCount = 0;
        }
        $data=[
            'pendingcomplaintcount' => $pendingcomplaints,
            'applicationCount' => $applicationCount
        ];

        $this->view('agn/Dashboard',$data);
    }
}

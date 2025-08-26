<?php

class Complaint
{
    use Controller;

    public function index(){
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }
    
        if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }
    
        $model = new ComplaintM(); 
        $data = $model->getComplaintStats();
    
        $this->view('agn/complaint', ['stats' => $data]);
    }
    
}

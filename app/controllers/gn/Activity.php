<?php

class Activity
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

        // get today action
        $gn_id = $_SESSION['user_id'];
        $activityModel = new ActivityM();
        $todayactivity = $activityModel->getTodayActivity($gn_id);
        $data =[
            'todayactivity' => $todayactivity,
        ];


        $this->view('gn/Activity', $data);
    }
    
    public function getTodayActivityLog() {
        $logModel = new ActivityM; // Or whatever model you use
        // $date = date("Y-m-d");
        $gn_id = $_SESSION['user_id'];
        $logs = $logModel->getTodayActivity($gn_id);
        
        
    
        echo json_encode($logs);
    }
    
}

<?php

class Notification
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
        
        $notificationModel = new NotificationModel();
        $user_id = $_SESSION['user_id'];
        $notifications = $notificationModel->getNotificationsByUserId($user_id);

        $this->view('agn/Notification', ['notifications' => $notifications]);
    }
}

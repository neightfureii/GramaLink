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

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $notificationModel = new NotificationModel();
        $user_id = $_SESSION['user_id'];
        $notifications = $notificationModel->getNotificationsByUserId($user_id);

        $this->view('gn/Notification', ['notifications' => $notifications]);
    }
}

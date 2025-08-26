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
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $notificationModel = new NotificationModel();
        $notifications = $notificationModel->getNotificationsByUserId($_SESSION['user_id']);

        $this->view('citizen/Notification', ['notifications' => $notifications]);
    }

    
}





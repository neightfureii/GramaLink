<?php

class Appointment
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

        // Fetch user details
        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $userDetails = $userModel->getGNById($user_id);

        $appointmentModel = new AppointmentModel();
        $appointments = $appointmentModel->getAppointmentsByGN($userDetails->gn_id);
        $this->view('gn/Appointment', ['user' => $userDetails, 'appointments' => $appointments]);
    }


    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appointmentModel = new AppointmentModel();
            $notificationModel = new NotificationModel();

            // Get form data
            $appointmentId = $_POST['appointment_id'];
            $action = $_POST['action'];
            $remarks = $_POST['remarks'] ?? null;

            $status = ($action === 'completed') ? 'Completed' : 'Rejected';
            $_POST['status'] = $status;

            $now = date('Y-m-d');
            if ($status == 'Completed') {
                $appointmentDate = $appointmentModel->getDate($appointmentId)[0]->preferred_date;
                if($now < $appointmentDate) {
                    $_SESSION['flash_message_reject'] = "Cannot Mark Completed appointment.";
                } else {
                    $appointmentModel->updateAppointmentStatus($appointmentId, $status, $remarks);
                    $appointmentCitizen = $appointmentModel->getAppointmentCitizen($appointmentId)[0];
                    $_POST['to'] = $appointmentCitizen->user_id;
                    $_POST['preferred_date'] = $appointmentCitizen->preferred_date;
                    $_POST['preferred_time'] = $appointmentCitizen->preferred_time;
                    $notificationModel->appointmentStatusUpdate($_POST);
                    $_SESSION['flash_message_complete'] = "Appointment Completed!";
                }
            } else {
                $appointmentDate = $appointmentModel->getDate($appointmentId)[0]->preferred_date;
                if($now >= $appointmentDate) {
                    $_SESSION['flash_message_reject'] = "Cannot reject appointment.";
                } else {
                    $appointmentModel->updateAppointmentStatus($appointmentId, $status, $remarks);
                    $appointmentCitizen = $appointmentModel->getAppointmentCitizen($appointmentId)[0];
                    $_POST['to'] = $appointmentCitizen->user_id;
                    $_POST['preferred_date'] = $appointmentCitizen->preferred_date;
                    $_POST['preferred_time'] = $appointmentCitizen->preferred_time;
                    $notificationModel->appointmentStatusUpdate($_POST);
                    $_SESSION['flash_message_complete'] = "Appointment Rejected!";
                }
            }
            
            // Redirect back to the appointments page
            header('Location: ' . ROOT . '/gn/appointment');
            exit;
        }
    }
}

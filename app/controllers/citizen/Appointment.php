<?php

class Appointment {
    use Controller;
    
    public function index() {
        // Check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:' . ROOT . '/login');
        }

        // Redirect based on user role
        if ($_SESSION['user_role'] === 'agn') {
            header('Location:' . ROOT . '/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:' . ROOT . '/gn/dashboard');
        }

        $appointmentModel = new AppointmentModel();
        $user_id = $_SESSION['user_id'];
        $citizenModel = new Citizen();
        $citizen = $citizenModel->getCitizenId($user_id);
        $gn = $citizenModel->getGnId($citizen->citizen_id);
        $userModel = new User();
        $userDetails = $userModel->getUserById($user_id);
        $appointments = $appointmentModel->getAllAppointments($citizen->citizen_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['citizen_id'] = $citizen->citizen_id;
            $_POST['gn_id'] = $gn->gn_id;
            
            if($appointmentModel->saveAppointment($_POST)) {
                $gnModel = new GramaNiladhari();
                $gnuserid = $gnModel->getUserByGN($_POST['gn_id']);
                $_POST['to'] = $gnuserid;
                
                //notification within web app
                $notificationModel = new NotificationModel();
                $notificationModel->newAppointment($_POST);
                
                //whatsapp notification
                $account_sid = ''; // SID
                $auth_token = ''; // Auth Token
                $twilio_number = 'whatsapp:+14155238886';  // Sandbox number
                $to = 'whatsapp:+94'.substr($userDetails->mobileNumber, 1); // WhatsApp number (linked to sandbox for testing. need whatsapp business in real app)
                
                $date = $_POST['preferred_date'];
                $time = $_POST['preferred_time'];
                $message = "Your Appointment has been confirmed for $date at $time.";
                
                $url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Messages.json";
                
                $data = [
                    'From' => $twilio_number,
                    'To' => $to,
                    'Body' => $message
                ];
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
                
                // if ($err) {
                //     echo "cURL Error: $err";
                // } else {
                //     echo "Message sent successfully!<br>Response:<br>";
                //     echo "<pre>$response</pre>";
                // }
                        
                //unsetting session variables
                if(!empty($_SESSION['applicationDetails'])) {
                    unset($_SESSION['applicationDetails']);
                } elseif(!empty($_SESSION['permitDetails'])) {
                    unset($_SESSION['permitDetails']);
                }
                if(session_status()==PHP_SESSION_NONE) echo "Session not started!";
                $_SESSION['flash_message'] = "Appointment booked successfully!<br/>You will recieve a confirmation via WhatsApp shortly.";
                header('Location:'. ROOT. '/citizen/Dashboard');
                exit;
            }            
        }
        
        if (!empty($_SESSION['applicationDetails'])) {
            $applicationDetails = $_SESSION['applicationDetails'];
            $this->view('citizen/Appointment', ['appointments' => $appointments, 'applicationDetails' => $applicationDetails]);
        }
        else if (!empty($_SESSION['permitDetails'])) {
            $permitDetails = $_SESSION['permitDetails'];
            $this->view('citizen/Appointment', ['appointments' => $appointments, 'permitDetails' => $permitDetails]);
        }
        else {
            $this->view('citizen/Appointment', ['appointments' => $appointments]);
        }
    }
    
    public function getTimeSlots($date) {
        // Set content type to JSON
        header('Content-Type: application/json');
        
        $appointmentModel = new AppointmentModel();
        $timeslots = $appointmentModel->getNATimeSlots($date);
        
        // Return JSON response
        echo json_encode($timeslots);
        exit; // Stop execution to prevent loading views
    }    
}

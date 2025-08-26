<?php 

class Report 
{
    use Controller;

    public function index() {
        // Check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
            exit;
        }

        if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
            exit;
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
            exit;
        }

        // If GET parameters are available
        if (isset($_GET['gn_division']) && isset($_GET['selected_date'])) {
            $gn_division = $_GET['gn_division'];
            $date = $_GET['selected_date'];
            $logModel = new ActivityM;
            $logs = $logModel->getActivityLog($gn_division, $date);

            header('Content-Type: application/json');
            echo json_encode($logs);
            exit; // 🚨 Important! Stop further execution
        }

        // For normal page load
        $this->view('agn/Report');
    }
}

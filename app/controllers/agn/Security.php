<?php
class Security
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

        $errors = [];
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current-password'] ?? '';
            $newPassword = $_POST['new-password'] ?? '';
            $confirmPassword = $_POST['confirm-password'] ?? '';

            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $errors['missing'] = "All fields are required.";
            } elseif ($newPassword !== $confirmPassword) {
                $errors['confirm'] = "New password and confirm password do not match.";
            } else {
                $user = new User();
                $userData = $user->getAGNById($_SESSION['user_id']);

                if (!$userData || !password_verify($currentPassword, $userData->password)) {
                    $errors['current'] = "Current password is incorrect.";
                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $user->updatePwd($_SESSION['user_id'], $hashedPassword);
                    $success = "Password changed successfully.";
                }
            }
        }
        
        $this->view('agn/Security', ['errors' => $errors, 'success' => $success]);
    }
}

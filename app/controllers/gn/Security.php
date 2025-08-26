<?php
class Security
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location:' . ROOT . '/login');
            exit;
        }

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:' . ROOT . '/agn/dashboard');
            exit;
        } elseif ($_SESSION['user_role'] === 'citizen') {
            header('Location:' . ROOT . '/citizen/home');
            exit;
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
                $userData = $user->getGNById($_SESSION['user_id']);

                if (!$userData || !password_verify($currentPassword, $userData->password)) {
                    $errors['current'] = "Current password is incorrect.";
                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $user->updatePwd($_SESSION['user_id'], $hashedPassword);
                    $success = "Password changed successfully.";
                }
            }
        }

        $this->view('gn/Security', ['errors' => $errors, 'success' => $success]);
    }
}

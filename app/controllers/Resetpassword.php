<?php

class Resetpassword
{
    use Controller;
    public function index()
    {
        $data = [];
        
       

        $userModel = new User;

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $token = $_POST['token'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            
            if(empty($newPassword) || strlen($newPassword) < 6){
                $_SESSION['error'] = "Password must be at least 6 characters long. ";
                $this->view('resetpassword', ['token' => $token]);
                return;
            }

            if($newPassword !== $confirmPassword){
                $_SESSION['error'] = "Password do not match.";
                $this->view('resetpassword', ['token' => $token]);
                return;
            }

            $resetData = $userModel->getResetToken($token);
            if($resetData){
                //update password
                $userModel->updatePassword($resetData->email,$newPassword);

                //delete token
                $userModel->deleteResetToken($token);
                $_SESSION['success'] = "Your password has been successfully reset";
                header("Location: " . ROOT . "/login");
                exit;

            }else{
                $_SESSION['error'] = "Invalid or expired token .";
                $this->view('resetpassword', $data);
            }
            
        }else{
            $data['token'] = $_GET['token'] ?? '';
            $this->view('resetpassword', $data);
        }

        $data['success'] = $_SESSION['success'] ?? null;
        $data['error'] = $_SESSION['error'] ?? null;
        unset($_SESSION['success'], $_SESSION['error']);
        
    }
}
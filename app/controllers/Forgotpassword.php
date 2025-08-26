<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

class Forgotpassword
{
    use Controller;
    public function index() 
    {
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = trim($_POST['email']);
            $userModel = new User;

            //check whether Ented email is valid

            if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $_SESSION['error'] = "Please enter a valid email address. ";
                $this->view('forgotpassword',$data);
                return;
            }
            $user = $userModel->first(['email' => $email]);
            
            
            if($user){
                $token = bin2hex(random_bytes(50));
                $userModel->storeResetToken($email,$token);
                $resetLink = ROOT ."/resetpassword?token=" .$token;

                //use phpMailer
                $mail = new PHPMailer(true);
                try{
                    
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = 'gramalink2025@gmail.com';
                    $mail->Password = 'hdmj hqgu ynxp qanr';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    // $mail->SMTPOptions = [
                    //     'ssl' => [
                    //         'verify_peer' => false,
                    //         'verify_peer_name' => false,
                    //         'allow_self_signed' => true
                    //     ]
                    // ];
                    $mail->setFrom('gramalink2025@gmail.com', 'GramaLink');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Password Reset Request";
                    $mail->Body = "<!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Password Reset</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f8f9fa;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    min-height: 100vh;
                                    margin: 0;
                                    padding: 20px;
                                }
                                
                                .container {
                                    background-color: white;
                                    border-radius: 10px;
                                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                    width: 100%;
                                    max-width: 500px;
                                    padding: 40px;
                                    text-align: center;
                                }
                                
                                h1 {
                                    font-size: 24px;
                                    margin-bottom: 30px;
                                    color: #333;
                                }
                                
                                p {
                                    color: #666;
                                    line-height: 1.6;
                                    margin-bottom: 20px;
                                }
                                
                                .info-text {
                                    font-size: 15px;
                                    margin-bottom: 30px;
                                }
                                
                                a {
                                    color: #17a2b8;
                                    text-decoration: none;
                                }
                                
                                a:hover {
                                    text-decoration: underline;
                                }
                                
                                .btn {
                                    display: inline-block;
                                    background-color: #ffc44d;
                                    color: #333;
                                    border: none;
                                    padding: 12px 24px;
                                    font-size: 16px;
                                    border-radius: 25px;
                                    cursor: pointer;
                                    margin-top: 20px;
                                    transition: background-color 0.3s;
                                }
                                
                                .btn:hover {
                                    background-color: #f5b73b;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='container'>
                              
                                
                                <h1>Forgot Password?</h1>
                                
                                <p class='info-text'>
                                    If you've lost your password or wish to reset it, use the link below to get started:
                                </p>
                                
                                
                                
                                <p>
                                    Click the button below to reset your password:
                                </p>
                                
                                <a href='$resetLink' class='btn'>Reset Your Password</a>
                            </div>
                        </body>
                        </html>";
                                
                        
                    $mail->send();
                    
                    $_SESSION['success'] = "Reset link send to your email";


                }catch(Exception $e){
                    $_SESSION['error'] = "Failed to sent email. Error:". $mail->ErrorInfo;
                }

            }else{
                $_SESSION['error'] = "Email Not Found .";
            }
            header("Location: " . ROOT ."/forgotpassword");
            exit;

        }

        $data['success'] = $_SESSION['success'] ?? null;
        $data['error'] = $_SESSION['error'] ?? null;
        unset($_SESSION['success'], $_SESSION['error']);
        $this->view('forgotpassword',$data);
    }

}

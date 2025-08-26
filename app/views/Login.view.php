<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama-Link Authentication</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/login.css" rel="stylesheet">
</head>
<body>
    <!-- Login Page -->
    <div class="modal">
        <div class="modal-content">
            <a href="guesthome" class="close">
                <i class="uil uil-times"></i>
            </a>
            <div class="logo-container">
                <img src="<?=ROOT?>/assets/images/gramalink_logo.png" alt="Grama-Link Logo" class="logo">
            </div>
            <h2><?=$text['Welcomebackto']?> <span class="grama-link">GRAMA-LINK</span></h2>
            
            <form method="POST">
                <?php if(!empty($errors)): ?>
                    <div class="error-message" style="text-align: center; color: white; font-size: 12px; font-weight: bold; background-color: rgb(244, 142, 142); border-radius: 10px; margin-bottom: 2rem;"><?=implode("<br>", $errors)?></div>
                <?php endif;?>
                <div class="form-group">
                    <label for="username"><?=$text['Username']?></label>
                    <input type="text" id="username" name="username">
                </div>

                <div class="form-group">
                    <label for="password"><?=$text['Password']?></label>
                    <div class="password-container">
                        <input type="password" id="password" name="password">
                    </div>
                </div>

                <div class="form-footer">
                    <a href="forgotpassword" class="forgot-password"><?=$text['ForgotPassword']?></a>
                </div>
                
                <button type="submit"><?=$text['Login']?></button>
            </form>
        </div>
    </div>
</body>
</html>
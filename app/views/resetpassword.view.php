<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/resetpassword.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>resetpassword</title>
</head>
<body>
   
  <div class="container">
    <div class="header">
      <div class="lock-icon">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#6e8efb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
      </div>
      <h1><?=$text['ResetYourPassword']?></h1>

      <p><?=$text['psscre']?></p>
    </div>
    <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
    <div class="form-container">
      <form id="resetPasswordForm"  method="POST">
        <input type="hidden" name="token" value="<?= $token ?? '' ?>">
       
        <div class="form-group">
          <label for="newPassword"><?=$text['NewPassword']?></label>
          <input type="password" id="newPassword" name="newPassword" autocomplete="new-password" required>
        </div>
        
        <div class="form-group">
          <label for="confirmPassword"><?=$text['ConfirmNewPassword']?></label>
          <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="new-password" required>
        </div>
        
        <button type="submit" class="btn-update"><?=$text['UpdatePassword']?></button>
      </form>
    </div>
    
    <div class="wave"></div>
  </div>

</body>
</html>
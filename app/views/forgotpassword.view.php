<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/forgotpassword.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Forgot password view</title>
</head>
<body>
    <div class="container">
        <div class="image-section">
            <svg class="illustration" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">

            <circle cx="200" cy="200" r="150" fill="#c1dee7"/>
            <circle cx="120" cy="150" r="50" fill="#c7d2fe"/>
            <circle cx="280" cy="100" r="30" fill="#c7d2fe"/>

            <rect x="100" y="150" width="200" height="180" rx="10" class="folder"/>
            <rect x="130" y="200" width="140" height="100" rx="5" fill="#dbeafe"/>
            <rect x="180" y="240" width="40" height="30" rx="5" class="lock"/>
            <path d="M190 240 V 255 C190 215 210 215 210 225 V 240" stroke="#ff6b6b" stroke-width="5" fill="none"/>

            <circle cx="280" cy="170" r="20" class="gears"/>
            <circle cx="280" cy="170" r="10" fill="white"/>
            <circle cx="320" cy="200" r="15" class="gears"/>
            <circle cx="320" cy="200" r="7" fill="white"/>

            <circle cx="80" cy="350" r="15" class="person"/>
            <rect x="75" y="365" width="10" height="25" class="person"/>
            <rect x="65" y="375" width="30" height="5" class="person"/>
            <rect x="75" y="390" width="5" height="15" class="person"/>
            <rect x="85" y="390" width="5" height="15" class="person"/>

            <circle cx="130" cy="350" r="15" class="key" />
            <rect x="130" y="335" width="8" height="40" class="key" />
            <rect x="138" y="345" width="15" height="8" class="key" />
            <rect x="138" y="355" width="15" height="8" class="key" />
            </svg>
        </div>
        <form method="POST" class="form-section">

            
                <h1>Forgot</h1>
                <div class="subtitle"><?=$text['YourPassword']?></div>
                <?php if(!empty($success)):?>
                    <div class="alert success" ><?=htmlspecialchars($success)?></div>
                <?php endif; ?>
                <?php if(!empty($error)):?>
                    <div class="alert error" ><?=htmlspecialchars($error)?></div>
                <?php endif; ?>
                <label for="email"><?=$text['EnterYourE-mail']?></label>
                <input type="email" id="email" name="email" required>
    
                <button type="submit" class="reset-btn"><?=$text['GetResetLink']?></button>
                <a href="Login" class="login-link"><?=$text['BackToLogin']?></a>
    
            
        </form>
    </div>
</body>
</html>

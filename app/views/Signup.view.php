<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama-Link Authentication</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/signup.css" rel="stylesheet">
</head>
<body>
    <!-- Signup Page -->
    <div class="modal">
        <div class="modal-content">
            <a href="guesthome" class="close">
                <i class="uil uil-times"></i>
            </a>
            <div class="logo-container">
                <img src="<?=ROOT?>/assets/images/gramalink_logo.png" alt="Grama-Link Logo" class="logo">
            </div>
            <h2>Join <span class="grama-link">GRAMA-LINK</span></h2>
            
            <form method="POST">
                <?php if(!empty($errors)): ?>
                    <div class="error-message" style="text-align: center; color: white; font-size: 12px; font-weight: bold; background-color: rgb(244, 142, 142); border-radius: 10px; margin-bottom: 2rem;">Please fix the errors</div>
                <?php endif;?>
                <?php if(!empty($citizen_errors)): ?>
                    <div class="error-message" style="text-align: center; color: white; font-size: 12px; font-weight: bold; background-color: rgb(244, 142, 142); border-radius: 10px; margin-bottom: 2rem;">NIC or Birth Certificate Number is invalid</div>
                <?php endif;?>

                <label for="nic">NIC Number:</label>
                <input type="text" id="nic" name="nic" value="<?=htmlspecialchars($_POST['nic'] ?? '')?>">
                <?php if(!empty($errors['nic'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['nic']?></div>
                <?php endif;?>

                <label for="bcnumber">Birth Certificate Number:</label>
                <input type="text" id="bcnumber" name="bcnumber" value="<?=htmlspecialchars($_POST['bcnumber'] ?? '')?>">
                <?php if(!empty($errors['bcnumber'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['bcnumber']?></div>
                <?php endif;?>

                <label for="mobileNumber">Mobile Number:</label>
                <input type="tel" id="mobileNumber" name="mobileNumber" value="<?=htmlspecialchars($_POST['mobileNumber'] ?? '')?>">
                <?php if(!empty($errors['mobileNumber'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['mobileNumber']?></div>
                <?php endif;?>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?=htmlspecialchars($_POST['email'] ?? '')?>">
                <?php if(!empty($errors['email'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['email']?></div>
                <?php endif;?>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?=htmlspecialchars($_POST['username'] ?? '')?>">
                <?php if(!empty($errors['username'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['username']?></div>
                <?php endif;?>

                <label for="password">Password:</label>
                <div class="loginpassword-container">
                    <input type="password" id="password" name="password" value="<?=htmlspecialchars($_POST['password'] ?? '')?>">
                </div>
                <?php if(!empty($errors['password'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['password']?></div>
                <?php endif;?>

                <label for="confirmpassword">Confirm Password:</label>
                <div class="loginpassword-container">
                    <input type="password" id="confirmpassword" name="confirmpassword" value="<?=htmlspecialchars($_POST['confirmpassword'] ?? '')?>">
                </div>
                <?php if(!empty($errors['confirmpassword'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['confirmpassword']?></div>
                <?php endif;?>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" <?=isset($_POST['terms']) ? 'checked' : ''?>>
                        <span>I agree to verify my identity. My information will be checked against official records.</span>
                    </label>
                </div>
                <?php if(!empty($errors['terms'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['terms']?></div>
                <?php endif;?>

                <button type="submit">Verify & Create Account</button>

                <p class="auth-footer">
                    Already have an account? 
                    <a href="login">Login</a>
                </p>
            </form>

        </div>
    </div>
</body>
</html>
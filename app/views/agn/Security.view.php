<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama Niladhari Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/profile.css"> 
</head>
<body>
    <?php if(!empty($success)) {
        echo "<div class='alert-success'>$success</div>";
    }?>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="dashboard"><div class="logo"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="gramalinklogo"></div></a>
            <ul>
                <li><a href="profile">Personal Info</a></li>
                <li><a href="security" class="active">Password & Security</a></li>
                <li><a href="contact">Contact & Address</a></li>
                <li><a href="notification">Notifications</a></li>
                <li><a href="settings">Settings</a></li>
            </ul>
        </div>
        <!-- Password & Security Panel -->
        <div id="password-security" class="content-panel">
            <div class="panel-header">
                <h3>Password & Security</h3>
            </div>
            
            <div class="form-section">
                <h4>Change Password</h4>
                <form action="<?=ROOT?>/agn/security" method="POST">	
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" id="new-password" name="new-password" oninput="checkPasswordStrength()">
                        <div class="password-strength">
                            <div class="strength-meter"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <?php if(!empty($errors)) {
                        foreach ($errors as $error) {
                            echo "<div style='color:red'>".$error."</div>";
                        }
                    }?>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/citizen/profile.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flash = document.getElementById('flash-message-success') || document.getElementById('flash-message-fail');
            if (flash) {
                setTimeout(function () {
                    flash.style.opacity = '0'; 
                    setTimeout(() => flash.remove(), 500);
                }, 3000); 
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama Niladhari Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/profile.css"> 
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="home"><div class="logo"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="gramalinklogo"></div></a>
            <ul>
                <li><a href="profile">Personal Info</a></li>
                <li><a href="security">Password & Security</a></li>
                <li><a href="contact" class="active">Contact & Address</a></li>
                <li><a href="notification">Notifications</a></li>
                <li><a href="settings">Settings</a></li>
            </ul>
        </div>

        <?php if (!empty($_SESSION['flash_message_complete'])): ?>
            <div id="flash-message-success" class="flash-success">
                <?= $_SESSION['flash_message_complete'] ?>
            </div>
            <?php unset($_SESSION['flash_message_complete']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['flash_message_reject'])): ?>
            <div id="flash-message-fail" class="flash-reject">
                <?= $_SESSION['flash_message_reject'] ?>
            </div>
            <?php unset($_SESSION['flash_message_reject']); ?>
        <?php endif; ?>

        <div id="contact-address" class="content-panel">
        <form action="<?=ROOT?>/citizen/contact/submitEditRequest" method="POST">
                <div class="panel-header">
                    <h3>Contact & Address</h3>
                </div>

                <div class="form-section">
                    <h4>Contact Information</h4>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?=$userDetails->email?>">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="mobileNumber" value="<?=$userDetails->mobileNumber?>">
                    </div>
                </div>

                <div class="form-section">
                    <h4>Residential Address</h4>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="<?=$userDetails->address?>">
                    </div>
                </div>

                <div class="form-section">
                    <h4>Other Details</h4>
                    <div class="form-group">
                        <label>Grama Niladhari Division</label>

                        <input type="text" value="<?=$userDetails->division_name?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Division Code</label>
                        <input type="text" value="<?=$userDetails->division_code?>" disabled>
                    </div>
                </div>

                <button class="btn edit-btn">Submit Edit Request</button>
            </form>
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

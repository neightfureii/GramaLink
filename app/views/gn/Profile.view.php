<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/profile.css"> 
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="dashboard"><div class="logo"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="gramalinklogo"></div></a>
            <ul>
                <li><a href="profile" class="active">Personal Info</a></li>
                <li><a href="security">Password & Security</a></li>
                <li><a href="contact">Contact & Address</a></li>
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

        <!-- Main Profile Section -->
        <div class="profile-content">
            <div class="profile-header">
                <h3>Personal Information</h3>
                <!-- <button class="edit-btn" onclick="toggleEdit()">Edit Profile</button> -->
            </div>

            <div class="profile-section">
                <div class="profile-photo" style="width: 30%;">
                    <img src="<?=ROOT . $gnDetails->image?>" alt="Profile Photo" id="profile-image">
                    <form action="<?=ROOT?>/gn/profile/changeImageRequest" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" id="edit-image" name="image">
                            <button type="submit" class="edit-btn" style="margin-top:1rem">Change Photo</button>
                        </div>
                    </form>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>Officer ID</label>
                        <div class="value"><?=$gnDetails->employee_id?></div>
                    </div>
                    <div class="detail-item">
                        <label>Division</label>
                        <div class="value"><?=$gnDetails->division_name?></div>
                    </div>
                    <div class="detail-item">
                        <label>Full Name</label>
                        <div class="value"><?=$gnDetails->full_name?></div>
                    </div>
                    <div class="detail-item">
                        <label>Appointed Date</label>
                        <div class="value"><?=$gnDetails->appointed_date?></div>
                    </div>
                    <div class="detail-item">
                        <label>NIC</label>
                        <div class="value"><?=$gnDetails->nic?></div>
                    </div>
                    <div class="detail-item">
                        <label>Service Status</label>
                        <div class="value"><?=$gnDetails->gn_is_active == 1 ? 'Active' : 'Inactive' ?></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
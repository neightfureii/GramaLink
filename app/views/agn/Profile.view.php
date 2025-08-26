<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/profile.css"> 
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

        <!-- Main Profile Section -->
        <div class="profile-content">
            <div class="profile-header">
                <h3>Personal Information</h3>
                <!-- <button class="edit-btn" onclick="toggleEdit()">Edit Profile</button> -->
            </div>

            <div class="profile-section">
                <div class="profile-photo">
                    <img src="<?=ROOT . $user->image?>" alt="Profile Photo" id="profile-image">
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>Officer ID</label>
                        <input type="text" value="AGN-2024-001">
                        <div class="value"><?=strtoupper($user->employee_id)?></div>
                    </div>
                    <div class="detail-item">
                        <label>Divisional Secratariat</label>
                        <div class="value">Maharagama</div>
                    </div>
                    <div class="detail-item">
                        <label>Full Name</label>
                        <div class="value"><?=$user->full_name?></div>
                    </div>
                    <div class="detail-item">
                        <label>Appointment Date</label>
                        <div class="value"><?=$user->appointed_date?></div>
                    </div>
                    <div class="detail-item">
                        <label>NIC</label>
                        <div class="value"><?=$user->nic?></div>
                    </div>
                    <div class="detail-item">
                        <label>Service Status</label>
                        <div class="value"><?=$user->is_active == 1 ? 'Active' : 'Inactive' ?></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/js/citizen/profile.js"></script>
</body>
</html>
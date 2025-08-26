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
                <li><a href="contact">Contact & Address</a></li>
                <li><a href="notification">Notifications</a></li>
                <li><a href="settings" class="active">Settings</a></li>
            </ul>
        </div>
        <!-- Settings Panel -->
        <div id="settings" class="content-panel">
            <div class="panel-header">
                <h3>Settings</h3>
            </div>
            <div class="settings-grid">
                <div class="setting-card">
                    <div class="setting-info">
                        <h4>Dark Mode</h4>
                        <p>Switch between light and dark themes</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" onchange="toggleDarkMode(this)">
                        <span class="slider"></span>
                    </label>
                </div>

               

        
                <!-- <div class="form-section">
                    <h4>Session Management</h4>
                    <div class="notification-list">
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>Current Session</h4>
                                <p>Chrome on Windows • Colombo, Sri Lanka</p>
                            </div>
                            <span>Active now</span>
                        </div>
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>Previous Session</h4>
                                <p>Safari on iPhone • Colombo, Sri Lanka</p>
                            </div>
                            <span>2 days ago</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="logoutAllDevices()">Logout from all devices</button>
                </div> -->
                <!-- Delete Account Section -->
            <!-- <div class="delete-account">
                <h4>Delete Account</h4>
                <p>After making a deletion request, you will have 6 months to restore your account. This action cannot be undone.</p>
                <button class="delete-btn" onclick="confirmDelete()">Delete Account</button>
            </div> -->
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/citizen/profile.js"></script>
</body>
</html>
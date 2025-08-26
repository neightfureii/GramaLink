<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama Niladhari Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/profile.css"> 
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="dashboard"><div class="logo"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="gramalinklogo"></div></a>
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
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/citizen/profile.js"></script>
</body>
</html>
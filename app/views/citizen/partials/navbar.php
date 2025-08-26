<?php
$userModel = new User();
$userDetails = $userModel->getUserById($_SESSION['user_id']);

$notificationModel = new NotificationModel();
$notifications = $notificationModel->getNotificationsByUserId($_SESSION['user_id']);

if(is_array($notifications)) {
    $notificationCount = count($notifications);
}
?>

<!-- Navbar Section -->
<nav>
    <div class="container nav__container">
        <a href="home" class="logo"></a>
        <ul class="nav__menu">
            <li><a href="home">Home</a></li>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contactus">Contact Us</a></li>
            <!-- Header Icons -->
            <div class="header-icons">
                <!-- Notification Button -->
                <div class="notification-wrapper">
                    <a class="notification-btn">
                        <i class="uil uil-bell" id="bellicon"></i>
                        <span class="notification-badge"><?=$notificationCount ?? 0?></span>
                    </a>

                    <!-- Notification Dropdown -->
                    <div class="notification-dropdown">
                        <div class="notification-header">
                            <h3>Notifications</h3>
                            <button class="mark-all-read">Mark all as read</button>
                        </div>
                        <div class="notification-list">
                            <!-- Notification Items -->
                            <?php if(!empty($notifications)):?>
                                <?php foreach($notifications as $notification):?>
                                    <div class="notification-item unread">
                                        <div class="notification-icon">
                                            <i class="uil uil-envelope"></i>
                                        </div>
                                        <div class="notification-content">
                                            <p><?=$notification->message?></p>
                                            <span class="notification-time"><?=$notification->created_at?></span>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="profile-wrapper">
                    <div class="profile-icon">
                        <img src="<?=ROOT.$userDetails->image?>" alt="User Profile" class="profile-image">
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <div class="profile-header">
                            <a href="profile"><img src="<?=ROOT.$userDetails->image?>" alt="User Profile"></a>
                            <a href="profile">
                                <div class="profile-info">
                                    <h4><?=$userDetails->full_name?></h4>
                                    <span><?=$userDetails->email?></span>
                                </div>
                            </a>
                        </div>
                        <div class="profile-menu">
                            <a href="settings"><i class="uil uil-setting"></i> Settings</a>
                            <a href="<?=ROOT?>/logout" class="logout-btn"><i class="uil uil-signout"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
        
        <button class="open-menu-button"><i class="uil uil-bars"></i></button>
        <button class="close-menu-button"><i class="uil uil-multiply"></i></button>
    </div>
</nav>


<script>
    // Select the navbar element
    const navbar = document.querySelector('nav');

    // Add a scroll event listener for navbar color change
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
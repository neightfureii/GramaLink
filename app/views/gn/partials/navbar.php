<?php
$userModel = new User();
$userDetails = $userModel->getGNById($_SESSION['user_id']);
?>

<aside class="sidebar">
    <div class="logo">
        <a href="dashboard"><img src="<?=ROOT?>/assets/images/gramalink_logo.png" alt="GramaLink Logo"></a>
    </div>
    <div class="menu-container">
    <ul class="menu">
        <li class="menu-item <?= $current_page == 'dashboard' ? 'active' : '' ?>">
            <a href="dashboard"><i class="fas fa-home"></i><span class="menu-text">Dashboard</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'appointment' ? 'active' : '' ?>">
            <a href="appointment"><i class="fas fa-calendar"></i><span class="menu-text">Appointments</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'application' ? 'active' : '' ?>">
            <a href="application"><i class="fas fa-file-alt"></i><span class="menu-text">Applications</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'citizensearch' ? 'active' : '' ?>">
            <a href="citizensearch"><i class="fas fa-search"></i><span class="menu-text">Citizen Search</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'complaint' ? 'active' : '' ?>">
            <a href="complaint"><i class="fas fa-exclamation-circle"></i><span class="menu-text">Complaints</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'fieldvisit' ? 'active' : '' ?>">
            <a href="fieldvisit"><i class="fas fa-map-marker-alt"></i><span class="menu-text">Field Visits</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'election' ? 'active' : '' ?>">
            <a href="election"><i class="fas fa-vote-yea"></i><span class="menu-text">Election</span></a>
        </li>
        <!-- <li class="menu-item">
            <a href="feedback"><i class="fas fa-star"></i><span class="menu-text">Feedback</span></a>
        </li> -->
        <li class="menu-item <?= $current_page == 'agnmessage' ? 'active' : '' ?>">
            <a href="agnmessage"><i class="fas fa-bell"></i><span class="menu-text">AGN Messages</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'activity' ? 'active' : '' ?>">
            <a href="activity"><i class="fas fa-pen"></i><span class="menu-text">Daily Activity</span></a>
        </li>
        <li class="menu-item <?= $current_page == 'announcement' ? 'active' : '' ?>">
            <a href="announcement"><i class="fas fa-book"></i><span class="menu-text">Notices</span></a>
        </li>
        <li class="menu-item">
            <a href="<?=ROOT?>/logout"><i class="fa fa-sign-out"></i><span class="menu-text">Logout</span></a>
        </li>
    </ul>
    </div>

    <div class="profile-section">
        <div class="profile-info">
                <a href="profile">
                    <div class="profile-avatar"><h4><img src="<?=ROOT . $userDetails->image?>" alt="GN_Image"></h4></div>
                </a>
                <a href="profile">
                    <div class="profile-details">
                        <div style="font-weight: 600;"><?=$userDetails->full_name?></div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">Grama Niladhari</div>
                    </div>
                </a>
            </div>
    </div>
</aside>
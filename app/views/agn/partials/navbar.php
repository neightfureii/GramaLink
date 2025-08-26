<aside class="sidebar">
    <div class="menu-container">
        <ul class="menu">
            <div class="logo">
                <a href="dashboard"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="GramaLink Logo"></a>
            </div>
            <li class="menu-item <?= $current_page == 'dashboard' ? 'active' : '' ?>">
                <a href="dashboard"><i class="uil uil-house-user"></i><span class="menu-text">Dashboard</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'gndetails' ? 'active' : '' ?>">
                <a href="gndetails"><i class="uil uil-user"></i><span class="menu-text">GN Details</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'citizendetails' ? 'active' : '' ?>">
                <a href="citizendetails"><i class="uil uil-users-alt"></i><span class="menu-text">Citizen Details</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'application' ? 'active' : '' ?>">
                <a href="application"><i class="uil uil-file-alt"></i><span class="menu-text">Review Applications</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'report' ? 'active' : '' ?>">
                <a href="report"><i class="uil uil-chart-bar"></i><span class="menu-text">Reports</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'notice' ? 'active' : '' ?>">
                <a href="announcement"><i class="uil uil-megaphone"></i><span class="menu-text">Notices</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'message' ? 'active' : '' ?>">
                <a href="message"><i class="uil uil-envelope"></i><span class="menu-text">Messages</span></a>
            </li>
            <li class="menu-item <?= $current_page == 'complaint' ? 'active' : '' ?>">
                <a href="complaint"><i class="uil uil-exclamation-circle"></i><span class="menu-text">All Complaints</span></a>
            </li>
        </ul>
    </div>
</aside>

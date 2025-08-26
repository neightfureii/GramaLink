<?php
$userModel = new User();
$userDetails = $userModel->getAGNById($_SESSION['user_id']);

$notificationModel = new NotificationModel();
$notifications = $notificationModel->getNotificationsByUserId($_SESSION['user_id']);
?>

<div class="header-icons">
    <div class="profile-section">
        <div class="profile-avatar" onclick="toggleProfileDropdown()"><img src="<?=ROOT . $userDetails->image?>" alt="AGN Image"></div>
    </div>

    <div class="profile-wrapper">
        <div class="profile-dropdown">
            <div class="profile-header">
                <a href="profile"><img src="<?=ROOT . $userDetails->image?>" alt="AGN Image"></a>
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
    
    <!-- notification button and components... -->
    <button class="notification-icon" onclick="toggleNotifications()">
        <i class="uil uil-bell"></i>
    </button>
    
    <div class="notification-wrapper">
        <div class="notification-dropdown">
            <div class="notification-header">
                <h3>Notifications</h3>
                <span class="mark-all-read" onclick="markAllAsRead()">Mark all as read</span>
            </div>
                        
            <div class="notification-list">
                <?php if(!empty($notifications)):?>
                    <?php foreach($notifications as $notification):?>
                        <div class="notification-item unread" data-type="appointment">
                            <div class="notification-content">
                                <i class="uil uil-calendar-alt"></i>
                                <div class="notification-text">
                                    <p><?=$notification->message?></p>
                                    <span class="notification-time"><?=$notification->created_at?></span>
                                </div>
                            </div>
                            <div class="notification-dot"></div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
                        
            <div class="notification-footer">
                <a href="#">View All Notifications</a>
            </div>
        </div>
    </div>
</div>

    


<script>

    // Notification dropdown toggle
    function toggleNotifications() {
        const dropdown = document.querySelector('.notification-dropdown');
        dropdown.classList.toggle('active');
    }


    function toggleProfileDropdown() {
        const dropdown = document.querySelector('.profile-dropdown');
        dropdown.classList.toggle('active');
    }

    function markAllAsRead() {
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        unreadItems.forEach(item => {
            item.classList.remove('unread');
            const dot = item.querySelector('.notification-dot');
            if (dot) {
                dot.style.display = 'none';
            }
        });
        updateNotificationBadge();
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        // Handle notification dropdown
        const notificationDropdown = document.querySelector('.notification-dropdown');
        const notificationIcon = document.querySelector('.notification-icon');
        
        if (!notificationIcon?.contains(e.target) && !notificationDropdown?.contains(e.target)) {
            notificationDropdown?.classList.remove('active');
        }
        
        // Handle profile dropdown
        const profileDropdown = document.querySelector('.profile-dropdown');
        const profileAvatar = document.querySelector('.profile-avatar');
        
        if (!profileAvatar?.contains(e.target) && !profileDropdown?.contains(e.target)) {
            profileDropdown?.classList.remove('active');
        }
    });

    // Show notification modal with details
    function showNotificationDetails(type, title, time, message, metadata) {
        const modal = document.getElementById('notificationModal');
        const iconContainer = modal.querySelector('.notification-icon-large i');
        const modalTitle = modal.querySelector('.notification-title');
        const modalTime = modal.querySelector('.notification-timestamp');
        const modalMessage = modal.querySelector('.notification-message p');
        const actionsContainer = modal.querySelector('.notification-actions');
        
        // Update icon based on notification type
        iconContainer.className = 'uil';
        switch(type) {
            case 'appointment':
                iconContainer.classList.add('uil-calendar-alt');
                actionsContainer.style.display = 'flex';
                break;
            case 'application':
                iconContainer.classList.add('uil-file-alt');
                actionsContainer.style.display = 'none';
                break;
            case 'complaint':
                iconContainer.classList.add('uil-exclamation-triangle');
                actionsContainer.style.display = 'none';
                break;
            case 'report':
                iconContainer.classList.add('uil-check-circle');
                actionsContainer.style.display = 'none';
                break;
            default:
                iconContainer.classList.add('uil-bell');
                actionsContainer.style.display = 'none';
        }
        
        // Update modal content
        modalTitle.textContent = title;
        modalTime.textContent = time;
        modalMessage.textContent = message;
        
        // Update metadata if available
        if (metadata) {
            const metadataContainer = modal.querySelector('.notification-metadata');
            metadataContainer.innerHTML = '';
            Object.entries(metadata).forEach(([key, value]) => {
                const p = document.createElement('p');
                p.innerHTML = `<strong>${key}:</strong> <span>${value}</span>`;
                metadataContainer.appendChild(p);
            });
        }
        
        // Show modal with animation
        modal.style.display = 'block';
        modal.querySelector('.modal-content').style.animation = 'slideIn 0.3s ease forwards';
    }

    function closeModal() {
        const modal = document.getElementById('notificationModal');
        modal.style.display = 'none';
    }

    // Add click handlers to notification items
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function() {
            // Get notification data
            const type = this.dataset.type;
            const title = this.querySelector('.notification-text p').textContent;
            const time = this.querySelector('.notification-time').textContent;
            const message = type === 'appointment' 
                ? 'John Doe has requested an appointment for Building Permit Application.'
                : 'Detailed message for this notification...';
            
            // Default metadata
            const metadata = {
                'Date': 'November 22, 2024',
                'Time': '10:30 AM',
                'Reference': 'REF-2024-001'
            };

            // Mark as read
            if (this.classList.contains('unread')) {
                this.classList.remove('unread');
                const dot = this.querySelector('.notification-dot');
                if (dot) dot.style.display = 'none';
                updateNotificationBadge();
            }

            // Show notification details
            showNotificationDetails(type, title, time, message, metadata);
        });
    });

    function updateNotificationBadge() {
        const unreadCount = document.querySelectorAll('.notification-item.unread').length;
        const badges = document.querySelectorAll('.notification-badge');
        
        badges.forEach(badge => {
            if (unreadCount === 0) {
                badge.style.display = 'none';
            } else {
                badge.style.display = 'block';
                badge.textContent = unreadCount;
            }
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('notificationModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Initial badge update
    updateNotificationBadge();
</script>
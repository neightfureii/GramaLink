<style>
    /* Icons on the right */
.header-icons {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.notification-icon {
  background: none;
  border: none;
  cursor: pointer;
  color: rgba(0, 0, 0, 0.438);
  font-size: 30px;
  transition: color 0.3s ease;
}

.notification-icon:hover {
  color: rgb(0, 0, 0);
}

/*=============Notification Icon===============*/
.notification-dropdownclass {
  position: absolute;
  top: 12%;
  right: 35%;
  width: 360px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
  padding: 0;
  margin-top: 20px;
  z-index: 100000;
  animation: fadeIn 0.3s ease-in-out;
}

.notification-header {
  padding: 15px 20px;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.notification-header h3 {
  font-size: 16px;
  font-weight: 600;
  color: var(--black1);
  margin: 0;
}

.mark-all-read {
  font-size: 13px;
  color: #2196f3;
  cursor: pointer;
  transition: color 0.3s;
}

.mark-all-read:hover {
  color: #1976d2;
}

.notification-list {
  max-height: 400px;
  overflow-y: auto;
}

.notification-item {
  padding: 15px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #eee;
  cursor: pointer;
  transition: background-color 0.3s;
}

.notification-item:hover {
  background-color: #f8f9fa;
}

.notification-item.unread {
  background-color: #f8f9fa;
}

.notification-content {
  display: flex;
  align-items: center;
  gap: 15px;
  flex: 1;
}

.notification-content i {
  font-size: 20px;
  color: #2196f3;
}

.notification-text p {
  margin: 0;
  font-size: 14px;
  color: var(--black1);
  line-height: 1.4;
}

.notification-time {
  font-size: 12px;
  color: #666;
}

.notification-dot {
  width: 8px;
  height: 8px;
  background-color: #2196f3;
  border-radius: 50%;
  margin-left: 10px;
}

.notification-footer {
  padding: 15px 20px;
  text-align: center;
  border-top: 1px solid #eee;
}

.notification-footer a {
  color: #2196f3;
  text-decoration: none;
  font-size: 14px;
  transition: color 0.3s;
}

.notification-footer a:hover {
  color: #1976d2;
}

@keyframes fadeIn {
  from {
      opacity: 0;
      transform: translateY(10px);
  }
  to {
      opacity: 1;
      transform: translateY(0);
  }
}


.notification-details {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.notification-icon-large {
  width: 50px;
  height: 50px;
  background-color: #e3f2fd;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.notification-icon-large ion-icon {
  font-size: 28px;
  color: #2196f3;
}

.notification-info {
  flex: 1;
}

.notification-title {
  margin: 0 0 5px 0;
  color: var(--black1);
  font-size: 16px;
  font-weight: 600;
}

.notification-timestamp {
  display: block;
  font-size: 13px;
  color: #666;
  margin-bottom: 15px;
}

.notification-message p {
  margin: 0 0 15px 0;
  color: var(--black2);
  line-height: 1.5;
}

.notification-metadata {
  background-color: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  margin-top: 15px;
}

.notification-metadata p {
  margin: 5px 0;
  font-size: 14px;
  color: var(--black2);
}

/* Add this to the existing notification-item styles */
.notification-item {
  cursor: pointer;
}

/* Animation for modal */
@keyframes slideIn {
  from {
      transform: translate(-50%, -60%);
      opacity: 0;
  }
  to {
      transform: translate(-50%, -50%);
      opacity: 1;
  }
}
</style>

<?php 
$notificationModel = new NotificationModel();
$notifications = $notificationModel->getNotificationsByUserId($_SESSION['user_id']);
if($notifications) {
  $notificationcount = count($notifications);
} else {
  $notificationcount = 0;
}
?>
<div class="header-icons">
    <!-- notification button and components -->
    <button class="notification-icon" onclick="toggleNotifications()">
        <i class="uil uil-bell"></i>
    </button>

    <div class="notification-dropdownclass" id="notification-dropdown" style="display: none;">
        <div class="notification-header">
            <h3>Notifications</h3>
            <span class="mark-all-read" onclick="markAllAsRead()">Mark all as read</span>
        </div>

        <div class="notification-list">
          <?php if(!empty($notifications)):?>
            <?php foreach($notifications as $notification): ?>
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
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div class="notification-footer">
            <a href="notification">View All Notifications</a>
        </div>
    </div>
</div>


    


<script>
    function toggleNotifications() {
        const dropdown = document.getElementById('notification-dropdown');
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('notification-dropdown');
        const button = document.querySelector('.notification-icon');
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });

    function markAllAsRead() {
        const items = document.querySelectorAll('.notification-item.unread');
        items.forEach(item => {
            item.classList.remove('unread');
        });
    }
</script>
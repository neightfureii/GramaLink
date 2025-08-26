<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grama Niladhari Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/profile.css">
    <style>
        .notification-item {
            padding: 16px;
            border-left: 4px solid transparent;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #fff;
            width:100%;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        /* Unread notification styles */
        .notification-item.unread {
            background-color: #f0f9ff;
            border-left-color: var(--primary);
        }

        .notification-item.unread .notification-info h4 {
            font-weight: 600;
        }

        /* Read notification styles */
        .notification-item.read {
            background-color: #fff;
            border-left-color: transparent;
            opacity: 0.8;
        }

        .notification-item.read .notification-info h4 {
            font-weight: normal;
        }

        .notification-info {
            flex: 1;
            margin-right: 16px;
        }

        .notification-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-time {
            color: #666;
            font-size: 14px;
        }

        .delete-notification {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .delete-notification:hover {
            background-color: #ffe5e5;
        }

        .notification-status {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary);
            margin-right: 8px;
            display: inline-block;
        }

        .read .notification-status {
            display: none;
        }

        .notification-success h4 { color: #28a745; }
        .notification-warning h4 { color: #ffc107; }
        .notification-info h4 { color: var(--primary); }
        .notification-announcement h4 { color: #6f42c1; }

        .empty-notifications {
            text-align: center;
            padding: 32px;
            color: #666;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .mark-all-read {
            background: none;
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mark-all-read:hover {
            background-color: var(--primary);
            color: white;
        }

        .unread-count {
            background-color: var(--primary);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: 8px;
        }
    </style>
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
                <li><a href="notification" class="active">Notifications</a></li>
                <li><a href="settings">Settings</a></li>
            </ul>
        </div>

        <!-- Notifications Panel -->
        <div id="notifications" class="content-panel">
            <div class="panel-header">
                <h3>Notifications</h3>
            </div>
            
            <div class="notification-header">
                <div>
                    <span id="unreadCount"></span>
                </div>
                <button class="mark-all-read" onclick="markAllAsRead()">Mark all as read</button>
            </div>

            <div class="notification-list" id="notificationList">
                <?php if (empty($notifications)): ?>
                    <div class="empty-notifications">
                        <h4>No notifications available</h4>
                    </div>
                <?php else: ?>
                    <?php foreach ($notifications as $notification): ?>
                        <div class="notification-item <?= $notification->is_read ? 'read' : 'unread' ?>" id="notification-<?= $notification->notification_id ?>">
                            <div class="notification-info">
                                <h4><?= $notification->title ?></h4>
                                <p><?= $notification->message ?></p>
                            </div>
                            <div class="notification-meta">
                                <span class="notification-time"><?= date('Y-m-d H:i', strtotime($notification->created_at)) ?></span>
                                <button class="delete-notification" onclick="deleteNotification(<?= $notification->notification_id ?>)">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
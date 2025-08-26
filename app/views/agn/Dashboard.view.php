<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <?php $current_page = 'dashboard'; include '../app/views/agn/partials/navbar.php'?>
    
    <div class="main-content">
        <header class="dashboard-header">
            <h2>Dashboard</h2>
            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>

        <!-- <header class="dashboard-header">
            <div class="header-actions">
                <div class="date-filter">
                    <select id="dateRange">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
            </div>
        </header> -->

        <div class="body-content">
            <section class="summary-cards">
                <div class="card">
                    <i class="fas fa-file-alt"></i>
                    <div class="card-content">
                        <h3>Total Applications</h3>
                        <p class="number"><?=$applicationCount?></p>
                        <!-- <p class="trend positive">+12.5% <span>vs last month</span></p> -->
                    </div>
                </div>
                <a href="PendingComplaint" style="text-decoration: none; color: black;">
                <div class="card">

                    <i class="fas fa-exclamation-circle"></i>
                    <div class="card-content">
                    <?php if(!empty($pendingcomplaintcount)): ?>
                        <?php foreach ($pendingcomplaintcount as $complaint): ?>
                            <h3>Pending Complaints</h3>
                        <p class="number"><?=htmlspecialchars($complaint->total_p_complaints)?></p>
                        <p class="trend negative">+5.2% <span>vs last month</span></p>
                    
                        <?php endforeach;?>
                    <?php else: ?>
                        <h3>Pending Complaints</h3>
                        <p class="number">0</p> 
                        <p class="trend negative">+0%<span>vs last month</span></p>
                    <?php endif;?>
                    </div>
                
                </div>
                </a>
                <div class="card">
                    <i class="fas fa-calendar-check"></i>
                    <div class="card-content">
                        <h3>Scheduled Visits</h3>
                        <p class="number">32</p>
                        <p class="trend positive">-8.4% <span>vs last month</span></p>
                    </div>
                </div>
                <div class="card">
                    <i class="fas fa-chart-line"></i>
                    <div class="card-content">
                        <h3>Reports</h3>
                        <p class="number">156</p>
                        <p class="trend positive">+15.7% <span>vs last month</span></p>
                    </div>
                </div>
            </section>

            <div class="dashboard-grid">
                <section class="recent-activities">
                    <div class="section-header">
                        <h2>Recent Activities</h2>
                        <button class="view-all">View All</button>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Application #2024-001 reviewed by GN</h4>
                                <p class="timestamp">2 hours ago</p>
                                <p class="details">Status changed to: Approved</p>
                            </div>
                            <div class="activity-action">
                                <button class="btn-view">View</button>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Complaint #C-892 marked as resolved</h4>
                                <p class="timestamp">5 hours ago</p>
                                <p class="details">Resolution: Issue addressed and verified</p>
                            </div>
                            <div class="activity-action">
                                <button class="btn-view">View</button>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Field visit completed - Site #LOC-445</h4>
                                <p class="timestamp">Yesterday</p>
                                <p class="details">Report pending submission</p>
                            </div>
                            <div class="activity-action">
                                <button class="btn-view">View</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="quick-actions">
                    <div class="section-header">
                        <h2>Quick Actions</h2>
                    </div>
                    <div class="action-buttons">
                        <button class="action-btn">
                            <i class="fas fa-plus"></i>
                            New Application
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-calendar-plus"></i>
                            Schedule Visit
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-file-export"></i>
                            Generate Report
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-clock"></i>
                            View Pending
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Date filter change handler
            document.getElementById('dateRange').addEventListener('change', function() {
                // Add your filter logic here
                console.log('Date range changed to:', this.value);
            });

            // Add click handlers for action buttons
            document.querySelectorAll('.action-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Add your action logic here
                    console.log('Action clicked:', this.textContent.trim());
                });
            });

            // Add view handlers for activities
            document.querySelectorAll('.btn-view').forEach(button => {
                button.addEventListener('click', function() {
                    const activityItem = this.closest('.activity-item');
                    const activityTitle = activityItem.querySelector('h4').textContent;
                    // Add your view logic here
                    console.log('Viewing activity:', activityTitle);
                });
            });

            // Simulated real-time updates (for demo purposes)
            setInterval(() => {
                const numbers = document.querySelectorAll('.number');
                numbers.forEach(number => {
                    const currentValue = parseInt(number.textContent);
                    const variation = Math.floor(Math.random() * 5) - 2; // Random variation between -2 and 2
                    number.textContent = currentValue + variation;
                });
            }, 5000);
        });
    </script>
</body>
</html>

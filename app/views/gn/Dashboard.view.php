<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/dashboard.css">
  </head>
  <style>
 .chart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 500px;
    height: 300px;
    margin: 0 auto;
}
canvas {
  width: 300px !important;
  height: 250px !important;
  align-items: center;
}
  </style>
<body>
    <?php $current_page = 'dashboard'; include '../app/views/gn/partials/navbar.php';?>
    <main class="main-content">
        <div class="header">
        <h2>Dashboard</h2>
        <div class="right" style="display:flex; gap:20px;">
            <?php include '../app/views/gn/partials/header_icons.php'; ?>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search citizens, applications...">
            </div>
        </div>
        </div>
      
        <div class="dashboard-grid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Applications</h3>
                    <span class="notification-badge">12</span>
                </div>
                <div style="color: var(--text-light)">Recent applications requiring review</div>
                <div class="quick-actions">
                    <a href="application"><button class="action-button">Review</button></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Today's Appointments</h3>
                    <span class="notification-badge">5</span>
                </div>
                <div style="color: var(--text-light)">Scheduled meetings for today</div>
                <div class="quick-actions">
                    <a href="appointment"><button class="action-button">View Schedule</button></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Field Visits</h3>
                    <span class="notification-badge">3</span>
                </div>
                <div style="color: var(--text-light)">Upcoming field inspections</div>
                <div class="quick-actions">
                    <a href="fieldvisit"><button class="action-button">Plan Route</button></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Urgent Complaints</h3>
                    <span class="notification-badge">2</span>
                </div>
                <div style="color: var(--text-light)">Complaints requiring immediate attention</div>
                <div class="quick-actions">
                    <a href="complaint"><button class="action-button">Handle</button></a>
                </div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-container">
                <h3>Gender Distribution</h3>
                <canvas id="activityChart" width="350" height="400"></canvas>
            </div>
            <div class="chart-container">
                <h3>Service Distribution</h3>
                <canvas id="serviceChart"></canvas>
            </div>
        </div>

        <div class="card">
        
            <h3>Daily Work Report</h3>
            <a href="Activity" class="btn-report">Get Report</a>
        
            <div class="task-list">
                <div class="task-item">
                    <div class="task-info">
                        <div class="status-dot completed"></div>
                        <div>
                            <div style="font-weight: 500;">Review Citizenship Applications</div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                <i class="fas fa-clock"></i> 09:00 AM
                            </div>
                        </div>
                    </div>
                    <span class="status-badge completed">Completed</span>
                </div>
                <div class="task-item">
                    <div class="task-info">
                        <div class="status-dot in-progress"></div>
                        <div>
                            <div style="font-weight: 500;">Field Visit - Housing Inspection</div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                            <i class="fas fa-clock"></i> 11:30 AM
                            </div>
                        </div>
                    </div>
                    <span class="status-badge in-progress">In Progress</span>
                </div>
                <div class="task-item">
                    <div class="task-info">
                        <div class="status-dot pending"></div>
                        <div>
                            <div style="font-weight: 500;">Community Meeting</div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                            <i class="fas fa-clock"></i> 02:00 PM
                            </div>
                        </div>
                    </div>
                    <span class="status-badge pending">Pending</span>
                </div>
            </div>
        </div>
    </main>
    
    <script>
  const statsData = <?php echo json_encode($data); ?>;
const maleCount = statsData.maleCount ? parseInt(statsData.maleCount.malecount) : 0;
const femaleCount = statsData.femaleCount ? parseInt(statsData.femaleCount.femalecount) : 0;
  
    console.log(maleCount);

    // Chart.js configurations
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    
    new Chart(activityCtx, {
    type: 'pie',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Gender Distribution',
            data: [maleCount, femaleCount], // Replace with real values
            backgroundColor: ['#2563eb', '#ef4444'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

const serviceCtx = document.getElementById('serviceChart').getContext('2d');
    // Service Distribution Chart
    new Chart(serviceCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [
                {
                    label: 'Applications',
                    data: [65, 59, 80, 81, 56, 55],
                    backgroundColor: '#2563eb'
                },
                {
                    label: 'Complaints',
                    data: [28, 35, 30, 25, 32, 27],
                    backgroundColor: '#ef4444'
                },
                {
                    label: 'Field Visits',
                    data: [42, 38, 45, 40, 36, 44],
                    backgroundColor: '#22c55e'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Search functionality
    const searchInput = document.querySelector('.search-bar input');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        // Add your search logic here
        console.log('Searching for:', searchTerm);
    });

    // Add hover effect to cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'transform 0.2s ease';
            this.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
        });
    });

    // Add button hover effects
    document.querySelectorAll('.action-button').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'all 0.2s ease';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add task item hover effects
    document.querySelectorAll('.task-item').forEach(task => {
        task.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'var(--background)';
            this.style.transition = 'background-color 0.2s ease';
        });

        task.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });

    // Handle window resize for responsive charts
    window.addEventListener('resize', function() {
        Chart.instances.forEach(chart => {
            chart.resize();
        });
    });

    // Add smooth scrolling to main content
    document.querySelector('.main-content').style.scrollBehavior = 'smooth';

    // Initialize tooltips for status badges
    const tooltipTexts = {
        completed: 'Task has been completed',
        'in-progress': 'Task is currently being worked on',
        pending: 'Task is scheduled but not started'
    };

    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.setAttribute('title', tooltipTexts[badge.classList[1]]);
    });
  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Complaint</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/complaint.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .dashboard-header {
            margin-bottom: 30px;
        }
        
        .dashboard-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }
        
        .dashboard-header p {
            color: #718096;
            font-size: 16px;
        }
        
        .dashboard {
            display: flex;
            gap: 300px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        
        .stats-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 300px;
        }
        
        .total-complaints {
            position: relative;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: conic-gradient(#4299e1 <?= min(100, (array_sum(array_column($stats, 'total_complaints')) / 100) * 100) ?>%, #e2e8f0 0);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .total-complaints::before {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            background-color: white;
            border-radius: 50%;
        }
        
        .count-content {
            position: relative;
            z-index: 10;
            text-align: center;
        }
        
        .count-label {
            font-size: 18px;
            font-weight: 500;
            color: #718096;
            margin-top: 8px;
        }
        
        .count-number {
            font-size: 46px;
            font-weight: 700;
            color: #2d3748;
        }
        
        .chart-container {
            flex: 0 0 400px;
            max-width: 400px;
            /* background-color: white; */
            /* border-radius: 12px; */
            padding: 20px;
            /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); */
            height: 300px;
            display: flex;
            flex-direction: column;
        }
        
        .chart-title {
            font-size: 18px;
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 15px;
            text-align: center;
        }
        
        #complaintPieChart {
            max-height: 250px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        
        thead {
            background-color: #f7fafc;
        }
        
        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
        }
        
        th {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td {
            color: #2d3748;
            font-size: 15px;
        }
        
        tbody tr:hover {
            background-color: #f7fafc;
        }
        
        .btn-view {
            background-color: #4299e1;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        
        .btn-view:hover {
            background-color: #3182ce;
        }
        
        .division-code {
            background-color: #ebf4ff;
            color: #4299e1;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 13px;
        }
        
        .complaint-count {
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                align-items: center;
            }
            
            .chart-container {
                width: 100%;
                max-width: 100%;
                margin-top: 30px;
            }
            
            .stats-container {
                width: 100%;
            }
            
            .total-complaints {
                width: 220px;
                height: 220px;
            }
            
            .total-complaints::before {
                width: 180px;
                height: 180px;
            }
        }
                /* Navigation Bar Styles Only */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 100;
            margin-bottom: 30px;
        }
        
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .navbar-logo {
            display: flex;
            align-items: center;
        }
        
        .navbar-logo img {
            height: 40px;
            margin-right: 12px;
        }
        
        .navbar-logo h2 {
            color: #2d3748;
            font-size: 20px;
            font-weight: 600;
        }
        
        .navbar-links {
            display: flex;
            align-items: center;
        }
        
        .navbar-links a {
            color: #4a5568;
            text-decoration: none;
            padding: 10px 16px;
            margin: 0 5px;
            font-weight: 500;
            font-size: 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .navbar-links a:hover {
            background-color: #edf2f7;
            color: #3182ce;
        }
        
        .navbar-links a.active {
            color: #3182ce;
            background-color: #ebf8ff;
        }
        
        .navbar-links a i {
            margin-right: 6px;
        }
        
        
        
        @media (max-width: 992px) {
            .navbar-container {
                height: 60px;
            }
            
            .navbar-links {
                display: none;
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                flex-direction: column;
                background-color: white;
                padding: 20px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                z-index: 100;
            }
            
            .navbar-links.show {
                display: flex;
            }
            
            .navbar-links a {
                width: 100%;
                padding: 12px 20px;
                margin: 2px 0;
            }
            
            

    </style>
</head>
<body>
    <?php $current_page = 'application'; include '../app/views/agn/partials/navbar.php';?>

    <?php if (!empty($_SESSION['flash_message_complete'])): ?>
        <div id="flash-message-success" class="flash-success">
            <?= $_SESSION['flash_message_complete'] ?>
        </div>
        <?php unset($_SESSION['flash_message_complete']); ?>
    <?php endif; ?>
    <?php if (!empty($_SESSION['flash_message_reject'])): ?>
        <div id="flash-message-fail" class="flash-reject">
            <?= $_SESSION['flash_message_reject'] ?>
        </div>
        <?php unset($_SESSION['flash_message_reject']); ?>
    <?php endif; ?>

    <div class="main-content">

        <header class="application-header">
            <h2>Review Complaints</h2>

            <div class="search-bar">
                <input type="text" placeholder="Search applications...">
                <button><i class="fas fa-search"></i></button>
            </div>

            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>

        <div class="dashboard">
            <div class="stats-container">
                <div class="total-complaints">
                    <div class="count-content">
                        <div class="count-number"><?= array_sum(array_column($stats, 'total_complaints')) ?></div>
                        <div class="count-label">Total Complaints</div>
                    </div>
                </div>
            </div>
            
            <div class="chart-container">
                <div class="chart-title">Complaint Distribution by Division</div>
                <canvas id="complaintPieChart"></canvas>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Division Code</th>
                    <th>Division Name</th>
                    <th>Total Complaints</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats as $row): ?>
                    <tr>
                        <td><span class="division-code"><?= $row->division_code ?></span></td>
                        <td><?= $row->division_name ?></td>
                        <td class="complaint-count"><?= $row->total_complaints ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        const ctx = document.getElementById('complaintPieChart').getContext('2d');
        const data = {
            labels: <?= json_encode(array_column($stats, 'division_name')) ?>,
            datasets: [{
                label: 'Complaint Distribution',
                data: <?= json_encode(array_column($stats, 'total_complaints')) ?>,
                backgroundColor: [
                    '#4299e1', '#f56565', '#48bb78', '#ed8936', '#667eea', '#9f7aea', '#ed64a6'
                ],
                borderWidth: 1,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        };
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>

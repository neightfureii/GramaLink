<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/view_complaint.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="complaint" class="crumb">Complaints</a> > <a href="view_complaint" class="crumb">View Complaint</a></p>
    </div>

    <div class="container view-complaint">
        <div class="complaint-details">
            <h2>Complaint ID: 2001</h2>
            <p><strong>Complaint Type:</strong> Noise Complaint</p>
            <p><strong>Description:</strong> Loud music from the neighbor's house during late hours.</p>
            <p><strong>Date Submitted:</strong> 2024-09-26</p>
            <p><strong>Status:</strong> In Progress</p>
            <p><strong>Location:</strong> 123 Main St, City</p>
        </div>

        <div class="comments-section">
            <h4>Admin Comments:</h4>
            <p>No updates yet.</p>
        </div>

        <div class="actions">
            <button id="updateStatus">Edit Complaint</button>
            <button id="updateStatus">Withdraw Complaint</button>
        </div>

    </div>
    
    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
    <script src="<?=ROOT?>/assets/js/citizen/view_complaint.js"></script>
</body>
</html>

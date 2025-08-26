<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/dashboard.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    
    <?php if (!empty($_SESSION['flash_message'])): ?>
        <div id="flash-message" class="flash-success">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a></p>
    </div>

    <!-- Dashboard Section -->
    <section class="container dashboard">
        <h1>Dashboard</h1>
        <div class="dashboard-cards">
            <a href="appointment">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/appointment.jpeg" alt="File Complaint">
                <h2>Appointments</h2>
                <p>Schedule a meeting with your local Grama Niladhari</p>
            </div>
            </a>
            <a href="application">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/application.jpg" alt="View Status">
                <h2>Applications and Certifications</h2>
                <p>Submit and Track Status of Applications</p>
            </div>
            </a>
            <a href="permit">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/permit.jpeg" alt="View Status">
                <h2>Permits</h2>
                <p>Request and Track Status of Permits</p>
            </div>
            </a>
            <a href="complaint">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/filecomplaint.jpg" alt="Complaint History">
                <h2>Complaints</h2>
                <p>File and Track Status of Complaints</p>
            </div>
            </a><a href="fieldvisit">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/fieldvisit.jpeg" alt="Complaint History">
                <h2>Field Visits</h2>
                <p>Confirm Field Visit Requests</p>
            </div>
            </a>
            <!-- <a href="housenumber">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/housenumber.jpg" alt="Complaint History">
                <h2>House Number</h2>
                <p>Request for a New House Number</p>
            </div>
            </a> -->
            <a href="voter">
            <div class="card">
                <img src="<?=ROOT?>/assets/images/election.jpg" alt="Complaint History">
                <h2>Election</h2>
                <p>Register for the Elections</p>
            </div>
            </a>
        </div>
    </section>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script>
     document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(function () {
                flash.style.opacity = '0'; 
                setTimeout(() => flash.remove(), 500);
            }, 3000);
        }
  });</script>
</body>
</html>

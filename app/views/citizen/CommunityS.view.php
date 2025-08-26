<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/CommunityS.css"> 
</head>
<body>
<aside class="sidebar">
        <h1 class="sidebar-title">Citizen Dashboard</h1>
        <ul class="sidebar-menu">
            <li><a href="Rules and Regulation Citizen.html">Rules & Regulation</a></li>
            <li></li>
            <li><a href="Announcement Citizen.html">Announcement</a></li>
            <li></li>
            <li><a href="Community Services Citizen.html" class="active">Community Services</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="section-header">
            <h2>Community Services</h2>
        </div>

        <div class="services-container" id="servicesContainer">
            <!-- Services will be dynamically populated here -->
        </div>
    </main>

    <!-- View Service Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Service Details</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Service details will be populated here -->
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/citizen/CommunityS.js"></script>
</body>
</html>
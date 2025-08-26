<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Grama-Link</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/housenumber.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="housenumber" class="crumb">House Number</a></p>
    </div>

    <div class="container house-number">
    <div class="wrapper">
    
        <div class="top">
        <i class="uil uil-receipt-alt"></i>
        </div>

        <div class="bottom">
            <div class="info">
                Enter Address <br> To get House Number
            </div>
            <form action="#" onsubmit="showHouseNumber(event)">
                <div class="input-box">
                    <input type="text" placeholder="Enter Address " required>
                </div>
                <div class="input-box">
                    <input type="submit" value="Submit">
                </div>
            </form>
            <!--hidden notice-->
            <div id="notice" class="notice hidden">
                House Number Is : A756
            </div>
        </div>
    </div>
    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
    <script src="<?=ROOT?>/assets/js/citizen/housenumber.js"></script>
</body>
</html>
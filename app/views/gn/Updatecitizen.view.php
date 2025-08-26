<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Update Citizen</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
     <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/updatecitizen.css">
</head>
<body>
    <?php $current_page = 'citizensearch'; include '../app/views/gn/partials/navbar.php';?>

    <main class="main-content">
        <div class="header">
            <h2>Update Citizen Details</h2>
            <!-- <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search citizen..." id="search-input">
            </div> -->
            <div class="input-group">
                <!-- <label for="nic">Citizen NIC Number</label> -->
                <input type="text" id="nic" placeholder="Enter NIC to fetch details">
                <button id="fetchDetailsBtn" class="btn-primary">Fetch Details</button>
            </div>
        </div>
        <div class="form-container">

            <table id="citizenTable" class="citizen-table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Existing Value</th>
                        <th>New Value</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows added here -->
                </tbody>
            </table>

            <button id="updateBtn" class="btn-update">Update Details</button>
        </div>
    </main>
    <script src="<?=ROOT?>/assets/js/gn/updatecitizen.js"></script>
</body>
</html>
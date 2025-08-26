<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permits</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/permit.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="permit" class="crumb">Permits</a></p>
    </div>

    <!-- Applications Section -->
    <div class="container wrapper">

        <div class="container applications-container">
            <!-- New Application Button -->
            <div class="new-application-button">
                <a href="new_permit" class="apply-btn">+ New Permit</a>
            </div>
            
            <h2 class="title">Permit History</h2>

            <table class="applications-table">
                <thead>
                    <tr>
                        <th>Permit Type</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($permitDetails)):?>
                        <?php foreach($permitDetails as $i):?>
                            <tr>
                                <td><?=$i->type?></td>
                                <td><?=$i->created_at?></td>
                                <td><?=$i->status?></td>
                            </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No permits found.</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
</body>
</html>

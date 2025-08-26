<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Residence Verification</title>

    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/residence.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>
    <?php $current_page = 'residence'; include '../app/views/citizen/partials/navbar.php';?>

    <div class="container wrapper">
        <div class="container applications-container">
            <div class="verification-card">
              <h1 class="page-title">Residence Verification</h1>
                <div class="info-banner">
                    <p>Please provide your current residence details for verification.</p>
                </div>
                
                <form action="<?=ROOT?>/citizen/residence/verify" method="POST" enctype="multipart/form-data" class="verification-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Current Residential Address</label>
                            <textarea name="address" required rows="3"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Duration of Residence</label>
                            <input type="text" name="duration" required placeholder="e.g., 2 years">
                        </div>
                        
                        <div class="form-group">
                            <label>Upload Proof of Residence</label>
                            <input type="file" name="documentProof" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">
                        Submit for Verification
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Residence verification page loaded');
        });
    </script>
</body>
</html>

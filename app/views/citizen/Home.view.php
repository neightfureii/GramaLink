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

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/home.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>
    
    <header>
        <div class="container header__container">
            <div class="header__left">
                <h1>Welcome to GramaLink !</h1>
                <p>
                Your trusted platform for easy access to Grama Niladhari services. Manage your applications, appointments, and official documents with convenience and transparency. We're here to simplify your administrative needs and support your community journey.
                </p>
                <a href="dashboard" class="call-to-action">Services ></a>
            </div>
            <div class="header__right">
                <div class="header__right-image">
                    <img src="<?=ROOT?>/assets/images/homebg.png" alt="header image">
                </div>
            </div>
        </div>
    </header>

    <section class="noticeboard">
        <div class="container noticeboard__container">
            <article class="notice">
                <div class="announcements">
                    <h2>Announcements</h2>
                    <p>Stay updated with the latest announcements from the community and administration.</p>
                    <a href="announcement" class="sectionbutton">View More</a>
                </div>
            </article>
            <article class="notice">
                <div class="rulesandregulations">
                    <h2>Rules and Regulations</h2>
                    <p>Read the rules and regulations to ensure smooth and effective use of our services.</p>
                    <a href="announcement" class="sectionbutton">View More</a>
                </div>
            </article>
            <article class="notice">
                <div class="communityservices">
                    <h2>Community Services</h2>
                    <p>Explore the various services available for the community through Grama-Link.</p>
                    <a href="announcement" class="sectionbutton">View More</a>
                </div>
            </article>
        </div>
    </section>
    

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
</body>
</html>

    



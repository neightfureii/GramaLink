<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/contactus.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>
    
    <header class="container contact__header">
        <div class="header__container">
            <h1>Contact Us</h1>
            <p>Have questions or need assistance? Get in touch with us!</p>
        </div>
    </header>

    <section class="container contact__section">
        <div class="contact__container">
            <form action="#" class="contact__form">
                <div class="form__group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" placeholder="Enter your name">
                </div>
                <div class="form__group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" placeholder="Enter your email">
                </div>
                <div class="form__group">
                    <label for="message">Message:</label>
                    <textarea id="message" rows="5" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="form__submit">Submit</button>
            </form>

            <div class="contact__info">
                <h2>Contact Information</h2>
                <p>Email: support@gramalink.gov.lk</p>
                <p>Phone: +94 123 456 789</p>
                <p>Address: 123 Government Road, Colombo, Sri Lanka</p>
            </div>
        </div>
    </section>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
</body>
</html>




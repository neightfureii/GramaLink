<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>

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
    
    <link href="https://fonts.googleapis.com/css2?family=Liter&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Sinhala:wght@100..900&family=Oxanium:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?=ROOT?>/assets/css/guesthome.css"> 
</head>
<body>
    <?php include '../app/views/partials/navbar.php'; ?>
    

    <header>
        <div class="container header__container">
            <div class="header__left">
                <h1><?=$text['welcome'] ?></h1>
                <p>
                    <?=$text['welcomeDesc']?>
                </p>
                <a href="login"><button class="call-to-action"><?=$text['getStarted']?></button></a>
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
                    <h2 ><?=$text['announcementTitle']?></h2>
                    <p ><?=$text['announcementText']?></p>
                    <a href="announcements" class="sectionbutton"><?=$text['viewmore']?></a>
                </div>
            </article>
            <article class="notice">
                <div class="rulesandregulations">
                    <h2 ><?=$text['rulesTitle']?></h2>
                    <p ><?=$text['rulesText']?></p>
                    <a href="rulesandregulations" class="sectionbutton"><?=$text['viewmore']?></a>
                </div>
            </article>
            <article class="notice">
                <div class="communityservices">
                    <h2><?=$text['communityTitle']?></h2>
                    <p><?=$text['communityText']?></p>
                    <a href="communityservices" class="sectionbutton" ><?=$text['viewmore']?></a>
                </div>
            </article>
        </div>
    </section>
    

    <?php include '../app/views/partials/footer.php'; ?>


    <script src="<?=ROOT?>/assets/js/guestmain.js"></script>
</body>
</html>
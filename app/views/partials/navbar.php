
<?php 
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>


<nav>
    <div class="container nav__container">
        <a href="guesthome" class="logo"></a>
        <ul class="nav__menu">

            <li><a href="guesthome"><?=$text['home']?></a></li>
            <li><a href="about"><?=$text['about']?></a></li>
            <li><a href="contactus"><?=$text['contactus']?></a></li>
            <li><a href="login"><button class="loginbutton"><?=$text['login']?></button></a>  </li>

        </ul>
        <button class="open-menu-button"><i class="uil uil-bars"></i></button>
        <button class="close-menu-button"><i class="uil uil-multiply"></i></button>
    </div>
</nav>

<script>
    // Select the navbar element
    const navbar = document.querySelector('nav');

    // Add a scroll event listener
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });


   


</script>
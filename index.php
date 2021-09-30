
<?php
$PAGE_ID = "home";
$PAGE_HEADER = "Welcome";
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit

require('TopMenu.php'); ?>

    <section id="one">
        <video class="background" src= "./media/main page background.mp4" loop autoplay muted></video>
        <div id="Title"><h1>Picture the best of your life</h1></div>
        <h3 id="subtitle">offering personalized photo-shoot plan <br> 
        and product that  keep your best day in <br>photograph</h3>
    </section>
    <?php require('Footer.php'); ?>
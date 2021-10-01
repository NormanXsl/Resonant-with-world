<?php session_start();
include("connection.php");
/** @var PDO $dbh */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "../css/style.css" />
    <title>Document</title>
</head>
<body>
    <section id="header-wrapper">
        <div id="header" class="container">
            <div id="menu">
                <li class="logo"><a href="#">Resonant with world</a></li>
                <ul>
                    <li><a href="../index.html" >Home</a></li>
                    <li><a href="#" >Product</a></li>
                    <li><a href="client.php">Client</a></li>
                    <li><a href="category.php" >Category</a></li>
                </ul>
            </div>
    </section>


    <footer id="copyright">
        <div class="title">
            <h2>Get in touch</h2></div>
            
            <div class ="box1">
                <h3>Offic AU</h3>
                <p>500 Unknown Street<br/>
                Melbourne, VIC 3170<br/><br/>
                123-456-789<br/>
                info@resonantwithworld.com</p>
        
            </div>
        <p id="disclaimer">Copyright (c) 2021 Resonantwithworld.com. All rights reserved.</p>
    </footer>

</body>
</html>
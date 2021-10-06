<?php
ob_start(); // To allow setting header when there's already page contents rendered

/** @var string $PAGE_ID Identify which page is loading the header, so the active menu item can be correctly recognised */
/** @var string $PAGE_HEADER The page title set in individual pages */
/** @var string $PAGE_USERNAME Username of the current logged in user */
/** @var string $PAGE_ALLOWGUEST If a page allows guest to visit */

// Database connection
require('connection.php');

/** @var PDO $dbh Database connection */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "./css/style.css" />
    <title>Resonant With World</title>
</head>
<body>
    <section id="header-wrapper">
        <div id="header" class="container">
            <div id = menuBar>
            <div id="menu">
                <li class="logo"><a href="index.php">Resonant with world</a></li>
                <ul>
                    <li <?= ($PAGE_ID == 'home') ? ' active' : '' ?>"><a href="index.php" >Home</a></li>
                    <li <?= ($PAGE_ID == 'products') ? ' active' : '' ?>"><a href="products.php" >Product</a></li>
                    <li class = dropdown <?= ($PAGE_ID == 'clients' ) ? ' active' : '' ?>"><a class = 'dropbtn'>Client</a> 
                    <div class="dropdown-content">
                        <a <?= ($PAGE_ID == 'client') ? ' active' : '' ?> href = 'client.php'>List all clients</a>
                        <a <?= ($PAGE_ID == 'client add') ? ' active' : '' ?> href = 'client_add.php'>Add new clients</a>
                        <a <?= ($PAGE_ID == 'email send') ? ' active' : '' ?> href = 'email.php'>Send email to clients</a>
                    </div>
                    </li>
                    <li class = dropdown <?= ($PAGE_ID == 'category' ) ? ' active' : '' ?>"><a class = 'dropbtn'>Category</a>
                    <div class="dropdown-content">
                        <a <?= ($PAGE_ID == 'category') ? ' active' : '' ?> href = 'category.php'>List all categories</a>
                        <a <?= ($PAGE_ID == 'category add') ? ' active' : '' ?> href = 'category_add.php'>Add new category</a>
                    </div>
                </li>
                <li class = dropdown <?= ($PAGE_ID == 'photo-shoot' ) ? ' active' : '' ?>"><a class = 'dropbtn'>Photo  Shoot</a>
                    <div class="dropdown-content">
                        <a <?= ($PAGE_ID == 'photo shoot insert') ? ' active' : '' ?> href = 'photo_shoot.php'>List all projects</a>
                        <a <?= ($PAGE_ID == 'photo shoot list') ? ' active' : '' ?> href = 'photo_shoot_insert.php'>Add new project</a>
                    </div>
                </li>
                </ul>
                <?php if (empty($PAGE_USERNAME)): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                Login
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                               Logout
                            </a>
                        </li>

                        <li class="nav-logout">
                           <p>
                              Hi, <?= $PAGE_USERNAME ?>
                            </p>
                        </li>
                    <?php endif; ?>
            </div>
            </div>
            
    </section>

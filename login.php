<?php
ob_start(); // To allow setting header when there's already page contents rendered
$PAGE_ID = "login";

// Database connection
require('connection.php');

/** @var PDO $dbh Database connection */

// Process login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        //Run some SQL query here to find that user
        $stmt = $dbh->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");
        if ($stmt->execute([
            $_POST['username'],
            hash('sha256', $_POST['password'])
        ]) && $stmt->rowCount() == 1) {
            $row = $stmt->fetchObject();
            $_SESSION['user_id'] = $row->id;
            //Successfully logged in, redirect user to referer, or index page
            if (empty($_SESSION['referer'])) {
                header("Location: index.php");
            } else {
                header("Location: " . $_SESSION['referer']);
            }
        } else {
            echo '<script>alert("Your username and/or password is incorrect. Please try again!")</script>';
        }
        exit();
    } else {
        echo '<script>alert("Please enter both username and password to login!")</script>';
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="login-bg">
<div class="login-box">
    <div class="text-center">
        <h1 class="login-title">Please login</h1>
    </div>
    <form class="user" method="post">
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="loginUsername" name="username" aria-describedby="emailHelp" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="loginUserPassword" name="password" placeholder="Password">
        </div class="form-group" id="form-button">
        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
    </form>
</div>
<script src="js/scripts.js"></script>
</body>

</html>
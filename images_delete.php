<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['image_id'])) {
    $query = "DELETE FROM `product_image` WHERE `image_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['image_id']]);
}

header('Location: images.php');
exit();
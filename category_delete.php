<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['category_id'])) {
    $query = "DELETE FROM `product_category` WHERE `category_fk` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['category_id']]);

    $query = "DELETE FROM `category` WHERE `category_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['category_id']]);
}

header('Location: category.php');
exit();
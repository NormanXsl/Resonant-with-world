<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $query = "DELETE FROM `category` WHERE `category_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['id']]);
}

header('Location: category.php');
exit();
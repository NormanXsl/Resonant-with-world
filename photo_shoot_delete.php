<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['photo_shoot_id'])) {
    $query = "DELETE FROM `photo_shoot` WHERE `photo_shoot_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['photo_shoot_id']]);
}

header('Location: photo_shoot.php');
exit();
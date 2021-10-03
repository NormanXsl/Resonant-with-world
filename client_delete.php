<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $query = "DELETE FROM `client` WHERE `client_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['id']]);
}

header('Location: client.php');
exit();
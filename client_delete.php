<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_id'])) {
    $query = "DELETE FROM `client` WHERE `client_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['client_id']]);
}

header('Location: client.php');
exit();
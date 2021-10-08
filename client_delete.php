<?php
require('connection.php'); 
/** @var PDO $dbh Database connection */


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_id'])) {
    // Delete image files first
    $query = "SELECT * FROM `client` WHERE `client_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute($_POST['client_id']);
    while ($image = $stmt->fetchObject()) {
        $fileFullPath = "product_images" . DIRECTORY_SEPARATOR . $image->filename;
        unlink($fileFullPath);
    }
    
    $query = "DELETE FROM `photoshoot` WHERE `client_fk` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    $stmt->execute($_POST['product_ids']);

    $query = "DELETE FROM `client` WHERE `client_id` = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_POST['client_id']]);
}

header('Location: client.php');
exit();
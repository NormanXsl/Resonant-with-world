<?php
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
$PAGE_ID = 'products delete';
require('connection.php');
$product_id = $_GET['product_id'];
$sql = "DELETE FROM product_image  where product_fk =".$product_id;
$dbh->exec($sql);
$sql1 = "DELETE FROM product where product_id =".$product_id;
$dbh->exec($sql1);
echo "<script>alert('success');window.location.href='detail.php';</script>";
<?php
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
$PAGE_ID = 'delete products';
require('connection.php');
$product_id = $_GET['product_id'];


//删除关联城市
$sql3 = "DELETE FROM product_category  where product_fk =".$product_id;
$dbh->exec($sql3);

//删除图片
$sql = "DELETE FROM product_image  where product_fk =".$product_id;
$dbh->exec($sql);

//删除产品信息
$sql1 = "DELETE FROM product where product_id =".$product_id;
$dbh->exec($sql1);


echo "<script>alert('success');window.location.href='products.php';</script>";
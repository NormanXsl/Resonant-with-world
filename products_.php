<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./layui/css/layui.css"  media="all">
<?php
error_reporting(0);
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
$PAGE_ID = 'products';
require('TopMenu.php');
$pagesize = 8; //每页显示数量
$page = intval($_GET['page']);//当前页码
$page = $page <= 0 ? 1 : $page; //如果页数小于等于0 ，页码就是第1页
//产品数据左联查询语句
$sql = "SELECT a.*,b.product_image_filename FROM product a left join product_image b on a.product_id = b.product_fk group by a.product_id";
//查询出产品
$product = $dbh->query($sql);
?>
</head>

</html>
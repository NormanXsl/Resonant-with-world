<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product add</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="//unpkg.com/layui@2.6.8/dist/css/layui.css">
    <?php
    error_reporting(0);
    $PAGE_ID = 'add products';
    require('TopMenu.php');

    function img($file='images',$path='./product_images/'){
        if(empty($_FILES[$file])){
            echo "<script>alert('image error');</script>";
        }
        $upfile=$_FILES[$file];
        $tmp_name=$upfile["tmp_name"];
        $imgname = time().$_FILES[$file]["name"];
        move_uploaded_file($tmp_name,$path.$imgname);
        $image = $imgname;
        return $image;
    }


        if(!empty($_POST)){
            $data = $_POST;
            $product_UPC = $_POST['product_UPC'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $sql = "INSERT INTO product (product_UPC,product_name,product_price) VALUES ('{$product_UPC}','{$product_name}','{$product_price}') ";
            $dbh->exec($sql);
            $id = $dbh->lastInsertId('product_id');
            $pata = img('product_image_filename');
            $sql1 = "insert into product_image (product_image_filename,product_fk) VALUES ('{$pata}',$id)";
            $res = $dbh->exec($sql1);
            if($res){
                echo "<script>alert('success');window.location.href='products.php';</script>";
            }else{
                echo "<script>alert('add error');</script>";
            }
        }
    ?>
</head>
<body>

<div class="layui-container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>product add</legend>
    </fieldset>

    <form class="layui-form layui-form-pane"   method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">UPC</label>
            <div class="layui-input-block">
                <input type="text" title="UPC should strictly include 12 numbers" required pattern="[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="product_UPC" autocomplete="off" placeholder="product_UPC..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">name</label>
            <div class="layui-input-block">
                <input type="text" maxlength="255" required name="product_name" autocomplete="off" placeholder="product_name..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">price</label>
            <div class="layui-input-block">
                <input type="number" max="9999999.99" title="Price should be the format of 8 or 8.00, any additional cents (for price) should be in the format of 7.29 or 9.50" required pattern="[0-9]+(\\.[0-9][0-9]?)?" name="product_price" autocomplete="off" placeholder="product_price..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">filename</label>
            <div class="layui-input-block">
                <input type="file" name="product_image_filename" autocomplete="off" placeholder="product_price..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">add</button>
        </div>
    </form>

</div>
<script src="//unpkg.com/layui@2.6.8/dist/layui.js">
<?php include'Footer.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product edit</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="//unpkg.com/layui@2.6.8/dist/css/layui.css">
    <?php
    error_reporting(0);
    $PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
    $PAGE_ID = 'edit products';
    require('TopMenu.php');

    //文件上传
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

    //查询要修改的数据
    if(!empty($_GET['product_id'])){
        $sql = "select * from product where product_id = ".$_GET['product_id'];
        $obj = $dbh->query($sql);
        $info =$obj->fetch();
        $sql2 = "select * from product_image where product_fk = ".$_GET['product_id'];
        $img = $dbh->query($sql2);
        $imginfo =$img->fetch();
    }



    //如果是表单提交数据
        if(!empty($_POST)){
            $data = $_POST;
            $product_UPC = $_POST['product_UPC'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_id = $_POST['product_id'];
             //修改产品
            $sql = "UPDATE product set product_UPC = '{$product_UPC}',product_name='$product_name',product_price='{$product_price}' where product_id =  ".$product_id;
            $dbh->exec($sql);

            //是否修改图片
            if(!empty($_FILES['product_image_filename']['name'])){
                $pata = img('product_image_filename');
                $sql = "UPDATE product_image set  product_image_filename = '{$pata}' where product_fk = ".$product_id;

                $dbh->exec($sql);
            }
                echo "<script>alert('success');window.location.href='products.php';</script>";
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
                <input type="text" name="product_UPC" value="<?php echo $info['product_UPC']?>" autocomplete="off" placeholder="product_UPC..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">name</label>
            <div class="layui-input-block">
                <input type="text" name="product_name" value="<?php echo $info['product_name']?>" autocomplete="off" placeholder="product_name..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">price</label>
            <div class="layui-input-block">
                <input type="text" name="product_price" value="<?php echo $info['product_price']?>" autocomplete="off" placeholder="product_price..." class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">filename</label>
            <div class="layui-input-block">

                <input type="file" name="product_image_filename" autocomplete="off" placeholder="product_price..." class="layui-input">
                <img src="./product_images/<?php if($info['product_id'] > 40){echo $imginfo['product_image_filename'];}else{echo str_replace('png','jpg',$imginfo['product_image_filename']);} ?>" >
                <span>You don’t need to re-upload the picture if you don’t modify the picture</span>
            </div>
        </div>

        <div class="layui-form-item">
            <input type="hidden" name="product_id" value="<?php echo $info['product_id'] ?>">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">edit</button>
        </div>
    </form>

</div>
<script src="//unpkg.com/layui@2.6.8/dist/layui.js">
<?php include'Footer.php'; ?>


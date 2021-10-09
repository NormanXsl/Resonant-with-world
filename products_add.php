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

    //如果是表单提交数据
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
                echo "<script>alert('success');window.location.href='detail.php';</script>";
            }else{
                echo "<script>alert('add error');</script>";
            }
        }
    ?>
</head>

</html>
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

    //查询要修改的数据
    if(!empty($_GET['product_id'])){
        $sql = "select * from product where product_id = ".$_GET['product_id'];
        $obj = $dbh->query($sql);
        $info =$obj->fetch();
        $sql2 = "select * from product_image where product_fk = ".$_GET['product_id'];
        $img = $dbh->query($sql2);
        $imginfo =$img->fetch();
    }




    ?>
</head>

</html>
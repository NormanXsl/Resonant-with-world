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
            if(!empty($_FILES['product_image_filename'])){
                $pata = img('product_image_filename');
                $sql = "UPDATE product_image set  product_image_filename = '{$pata}' where product_fk = ".$product_id;

                $dbh->exec($sql);
            }
                echo "<script>alert('success');window.location.href='detail.php';</script>";
        }
    ?>
</head>

</html>
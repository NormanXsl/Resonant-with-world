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
    <a type="button" href="add.php" class="layui-btn">add product</a>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>product list</legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>product_id</th>
                <th>product_UPC</th>
                <th>product_name</th>
                <th>product_price</th>
                <th>product_image_filename</th>
                <th>Set up the</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($product as $k=>$v){
           ?>
            <tr>
                <td><?php echo $v['product_id']?></td>
                <td><?php echo $v['product_UPC']?></td>
                <td><?php echo $v['product_name']?></td>
                <td><?php echo $v['product_price']?></td>
                <td><img src="./product_images/<?php if($v['product_id'] > 40){echo $v['product_image_filename'];}else{echo str_replace('png','jpg',$v['product_image_filename']);} ?>" ></td>
                <td>
                    <a type="button" href="edit.php?product_id=<?php echo $v['product_id']?>" class="layui-btn layui-btn-primary layui-border-blue">edit product</a>
                    <a type="button" href="delete.php?product_id=<?php echo $v['product_id']?>" class="layui-btn layui-btn-primary layui-border-red">delete product</a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script src="./layui/layui.js" charset="utf-8"></script>

<script>
</script>

</body>
</html>
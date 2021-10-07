<?php
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
$PAGE_ID = 'products';
require('TopMenu.php');
$pagesize = 8; //每页显示数量
$page = intval($_GET['page']);//当前页码
$page = $page <= 0 ? 1 : $page; //如果页数小于等于0 ，页码就是第1页
$cid = intval($_GET['cid']);    //获取分类id
$category = $dbh->query("SELECT * FROM `category`");//获取分类数据
$where = "";
if ( $cid > 0 ){
    $where = " WHERE c.category_id = {$cid}";   //如果分类ID 大于0 就查询该分类ID下的产品
}
//产品数据左联查询语句
$sql = "SELECT a.*,p.product_image_filename,c.category_name FROM `product` a LEFT JOIN `product_image` p ON p.product_fk = a.product_id LEFT JOIN `product_category` pc ON pc.product_fk = a.product_id LEFT JOIN `category` c ON pc.category_fk = c.category_id {$where}  LIMIT ".($page - 1) * $pagesize.",{$pagesize} ";
//查询出产品
$product = $dbh->query($sql);
//产品数量SQL
$sqlCount =  "SELECT count(*) AS count FROM `product` a LEFT JOIN `product_image` p ON p.product_fk = a.product_id LEFT JOIN `product_category` pc ON pc.product_fk = a.product_id LEFT JOIN `category` c ON pc.category_fk = c.category_id {$where}  ";
$count = $dbh->prepare ($sqlCount);
$count->execute();
//取得产品数量
$count = $count->fetchAll(PDO::FETCH_COLUMN);
$count = $count[0];
//计算总页数
$total = ceil($count / $pagesize);

?>
<link rel="stylesheet" href= "./css/product.css" />
    <section id="product">
    <div style="height:150px"></div>
        <div class="cate">
        <a href="./products.php">ALL</a>
            <?php
            foreach( $category AS $key => $v ){

            
            ?>
            <a href="./products.php?cid=<?php echo $v['category_id']?>"><?php echo $v['category_name']?></a>
            <?php }?>
        </div>
        <div class="list">
            <?php
            foreach( $product AS $key => $v){
            ?>
            <div class="item">
                <div class="img">
                    <img src="./product_images/<?php echo str_replace('png','jpg',$v['product_image_filename'])?>" />
                </div>
                <div class="name"><?php echo $v['product_name']?></div>
                <div class="price">$<?php echo $v['product_price']?></div>
                <div class="star">
                    <?php for($i = 0; $i < 5; $i++){?>
                        <img src="./media/star.png" />
                    <?php }?>
                </div>
                <div class="quality">
                    <div class="text">Quality:</div>
                    <div class="input">
                        <input type="number" value="1" />
                        <div class="icon"></div>
                    </div>
                </div>
                <div class="btn">
                    <a href="javascript:;" class="detail">see details</a>
                    <a href="javascript:;" class="cart">add to cart</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="page">
            PAGE NO:
            <?php for($i = 1; $i <= $total; $i++){?>
            <a <?php if($page == $i){echo "class='cur'";}?> href="/products.php?page=<?php echo $i;?>&cid=<?php echo intval($_GET['cid'])?>"><?php echo $i;?></a>
            <?php
            }
            ?>
        </div>
       
    </section>
    <?php require('Footer.php'); ?>
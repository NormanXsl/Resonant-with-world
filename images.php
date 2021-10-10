
<?php
$PAGE_ID = "images";
$PAGE_HEADER = "Images";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); 

if (isset($_GET['product_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `product` WHERE `product_id` = ?");
    if ($stmt->execute([$_GET['product_id']])) {
            $product = $stmt->fetchObject();
    }
}


?>

<div id=page-body>
    <h2 class='title-text'>List of photo shoot records
    </h2><br>
    <p class='text'>The table below shows all the images in the database.</p>
    <?php
    
    $query = "SELECT * FROM `product_image`;";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute()) : ?>
        <form method="POST" action="images_delete.php">
            <table class='center table-bordered' width="99%" cellspacing="0">
                <thead>
                    <tr>
                        <th><span class='header-text'>Image ID</span></th>
                        <th><span class='header-text'>Image</span></th>
                        <th><span class='header-text'>File Name</span></th>
                        <th><span class='header-text'>Product</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $stmt->fetchObject()) : ?>
                        <tr>
                            <td align='center'><span class='table-text'><?= $row->image_id ?></span></td>
                            <td><img src="./product_images/<?= str_replace('png','jpg',$row->product_image_filename) ?>" width="200" height="200" class="rounded mb-1 product-image-thumbnail" alt="Product Image"></td>
                            <td><span class='table-text'><code><?= $row->product_image_filename ?></code></span></td>
                            <td><span class='table-text'><code><?= $row->product_fk ?></code></span></td>
                            <td align='center'>
                                <a class="btn btn-green" href="products_edit.php?product_id=<?= $row->product_fk ?>"><span class='button-text'>View</span></a>
                                <button type="submit" onClick='return confirm("Are you sure you want to delete this image?")' class='btn btn-red' name="image_id" value="<?= $row->image_id ?>"><span class='button-text'>Delete</span></button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    <?php else : ?>
        <p class="text">There are no other images information in the database. </p>
    <?php endif; ?>
</div>
<a class="btn btn-blue" href="images_code.php" ><span class = 'button-text'>Click to see code</span></a>
<?php require('Footer.php'); ?>


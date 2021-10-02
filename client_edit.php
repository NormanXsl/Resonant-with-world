<?php
$PAGE_ID = "client edit";
$PAGE_HEADER = "Edit client information";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['client_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `client` WHERE `client_id` = ?");
    if ($stmt->execute([$_GET['client_id']])) {
        if ($stmt->rowCount() == 1) {
            $client = $stmt->fetchObject();
        }
    }
}
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Edit client information</h1> #<?= $client->client_id ?></h1>
        <p class="mb-4">This page allows you to add a new product to the system</p>
        <?php if (isset($ERROR)): ?>
            <div class="card mb-4 border-left-danger">
                <div class="card-body">Cannot modify the product due to the following error:<br><code>
                        <ul>
                            <li><?= $ERROR ?></li>
                        </ul>
                    </code></div>
            </div>
        <?php endif; ?>
        <form method="post" id="add-products" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Name</label>
                <input type="text" class="form-control" id="productName" name="name" maxlength="64" required value="<?= empty($_POST['name']) ? $product->name : $_POST['name'] ?>">
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea class="form-control" id="productDescription" name="description" rows="5" maxlength="65535"><?= empty($_POST['description']) ? $product->description : $_POST['description'] ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="productPurchasePrice">Purchase price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="productPurchasePriceDollar">$</span>
                        </div>
                        <input type="number" class="form-control" aria-describedby="productPurchasePriceDollar" id="productPurchasePrice" name="purchase_price" required step=".01" max="9999999.99" min="0" value="<?= empty($_POST['purchase_price']) ? $product->purchase_price : $_POST['purchase_price'] ?>">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="productSalePrice">Sale price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="productSalePriceDollar">$</span>
                        </div>
                        <input type="number" class="form-control" aria-describedby="productSalePriceDollar" id="productSalePrice" name="sale_price" required step=".01" max="9999999.99" min="0" value="<?= empty($_POST['sale_price']) ? $product->sale_price : $_POST['sale_price'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="productSalePrice">Product images</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="productProductImages" aria-describedby="productProductImagesFeedback" name="images[]" multiple>
                    <label class="custom-file-label" for="customFile">Add more images to this product</label>
                    <div id="productProductImagesFeedback" class="invalid-feedback" id="productProductImagesFeedback">File error</div>
                </div>
                <div class="form-group mt-2">
                    <?php if (empty($product_images)): ?>
                        <p>This product has no images</p>
                    <?php else: ?>
                        <p>Tick the box in front of each image to delete that image</p>
                        <?php foreach ($product_images as $image): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="productProductImageDelete-<?= $image->id ?>" name="delete_images[]" value="<?= $image->id ?>" <?= (isset($_POST['delete_images']) && in_array($image->id, $_POST['delete_images'])?"checked":"") ?>>
                                <label class="form-check-label" for="productProductImageDelete-<?= $image->id ?>"><img src="product_images/<?= $image->filename ?>" width="200" height="200" class="rounded mb-1 product-image-thumbnail" alt="Product Image"></label>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit changes</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>
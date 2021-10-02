<?php
$PAGE_ID = "category edit";
$PAGE_HEADER = "Edit Categories";

require('header.php');

/** @var PDO $dbh Database connection */
/** @var object $product Product details */
/** @var object $product_images Product images */

if (isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `products` WHERE `id` = ?");
    if ($stmt->execute([$_GET['id']])) {
        if ($stmt->rowCount() == 1) {
            $product = $stmt->fetchObject();

            // Fetch product images
            $product_images = [];
            $stmt = $dbh->prepare("SELECT * FROM `product_images` WHERE `product_id` = ?");
            $stmt->execute([$_GET['id']]);
            while ($image = $stmt->fetchObject()) {
                $product_images[] = $image;
            }

            $product_fetched = true;
        }
    }
}

// Something goes wrong, send user back to product list page
if (!(isset($product_fetched) && $product_fetched)) {
    header("Location: products.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // PHP $_FILES error readable references
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    // Allowed MIME types
    $allowedMIME = array(
        'image/jpeg',
        'image/png',
        'image/gif'
    );

    $modifiedProductId = $product->id;

    if (!empty($_POST['name']) &&
        !empty($_POST['purchase_price']) &&
        !empty($_POST['sale_price'])) {

        $serverSideErrors = [];
        $filenames = [];

        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();

        // Update product details
        $query = "UPDATE `products` SET `name` = ?, `description` = ?, `purchase_price` = ?, `sale_price` = ? WHERE `id` = ?";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['name'],
            empty($_POST['description']) ? null : $_POST['description'],
            $_POST['purchase_price'],
            $_POST['sale_price'],
            $modifiedProductId
        ];
        if ($stmt->execute($parameters)) {
            // If no file is uploaded, then no need to process uploaded files
            if (!(isset($_FILES['images']['error'][0]) && $_FILES['images']['error'][0] == 4)) {
                // Check if any of the files has error during upload
                foreach ($_FILES['images']['error'] as $index => $error) {
                    if ($error != 0) {
                        $serverSideErrors[] = "File '" . $_FILES['images']['name'][$index] . "' did not upload because: " . $phpFileUploadErrors[$error];
                        break;
                    }
                }

                // Check if any of the files is in wrong MIME type
                foreach ($_FILES['images']['type'] as $index => $type) {
                    if (!empty($type) && !in_array($type, $allowedMIME)) {
                        $serverSideErrors[] = "The type of file '" . $_FILES['images']['name'][$index] . "' (" . $type . ") is not allowed";
                        break;
                    }
                }

                // Insert new product images to product_images table
                if (empty($serverSideErrors)) {
                    foreach ($_FILES['images']['name'] as $index => $filename) {
                        $query = "INSERT INTO `product_images`(`product_id`, `filename`) VALUES (?, ?)";
                        $stmt = $dbh->prepare($query);
                        $currentFileName = uniqid('product_' . $modifiedProductId . '_', true) . "." . pathinfo($filename, PATHINFO_EXTENSION);
                        if ($stmt->execute([$modifiedProductId, $currentFileName])) {
                            $filenames[$index] = $currentFileName;
                        } else {
                            $serverSideErrors[] = $stmt->errorInfo()[2];
                            break;
                        }
                    }
                }

                // Move images to its final place
                if (empty($serverSideErrors)) {
                    foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
                        if (!move_uploaded_file($tmp_name, "product_images" . DIRECTORY_SEPARATOR . $filenames[$index])) {
                            $serverSideErrors[] = "Failed to save image files to the filesystem.";
                            break;
                        }
                    }
                }
            }

            // Delete selected files from both database and filesystem
            if (empty($serverSideErrors)) {
                if (isset($_POST['delete_images']) && !empty($_POST['delete_images'])) {
                    $query_placeholders = trim(str_repeat("?,", count($_POST['delete_images'])), ",");
                    $query = "DELETE FROM `product_images` WHERE `id` in (" . $query_placeholders . ")";
                    $stmt = $dbh->prepare($query);
                    if (!$stmt->execute($_POST['delete_images'])) {
                        $serverSideErrors[] = $stmt->errorInfo()[2];
                    }
                }
            }
            if (empty($serverSideErrors)) {
                $filenames = [];
                foreach ($product_images as $image) {
                    $filenames[$image->id] = $image->filename;
                }
                foreach ($_POST['delete_images'] as $delete_image_id) {
                    $fileFullPath = "product_images" . DIRECTORY_SEPARATOR . $filenames[$delete_image_id];
                    if (!unlink($fileFullPath)) {
                        $serverSideErrors[] = "File '" . $filenames[$delete_image_id] . "' cannot be deleted";
                        break;
                    }
                }
            }
        } else {
            $serverSideErrors[] = $stmt->errorInfo()[2];
        }

        if (empty($serverSideErrors)) {
            $dbh->commit();
            header("Location: products_detail.php?id=" . $modifiedProductId);
            exit();
        } else {
            $dbh->rollBack();
            $ERROR = implode("</li><li>", $serverSideErrors);
        }

    } else {
        $ERROR = "The request is invalid. This may be due to the uploaded files are too large to process.";
    }

}
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Edit product #<?= $product->id ?></h1>
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
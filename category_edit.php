<?php
$PAGE_ID = "category edit";
$PAGE_HEADER = "Edit category information";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['category_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `category` WHERE `category_id` = ?");
    if ($stmt->execute([$_GET['category_id']])) {
        if ($stmt->rowCount() > 0) {
            $category = $stmt->fetchObject();

            $cateogry_fetched = true;

        }
    }
}
if (!(isset($cateogry_fetched) && $cateogry_fetched)) {
    header("Location: category.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modifiedCategoryId = $category->category_id;

    if (!empty($_POST['category_name'])) {

        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();
        $serverSideErrors = [];

        $query = "UPDATE `category` SET `category_name` = ? WHERE `category_id` = ?";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['category_name'],
            $modifiedCategoryId
        ];

        $stmt->execute($parameters);
        
        if (empty($serverSideErrors)) {
            $dbh->commit();
            header("Location: category_detail.php?category_id=" . $modifiedCategoryId);
            exit();
        } else {
            $dbh->rollBack();
            $ERROR = implode("</li><li>", $serverSideErrors);
        }
    }
    
} 

?>
    <!-- Begin Page Content -->
    <div id="page-body">
        <!-- Page Heading -->
        <h2 class = 'title-text'>Edit category #<?= $category->category_id ?></h2>
        <?php if (isset($ERROR)): ?>
            <div class="card mb-4 border-left-danger">
                <div class="card-body">Cannot modify the category due to the following error:<br><code>
                        <ul>
                            <li><?= $ERROR ?></li>
                        </ul>
                    </code></div>
            </div>
        <?php endif; ?>
        <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <div class="input-group">
                <input type="text" class="form-control" id="category_name" name="category_name" maxlength="255" required value="<?= empty($_POST['category_name']) ? $category->category_name : $_POST['category_name'] ?>">
                </div>
        </div>
        <button type="submit" class="btn btn-blue">Submit changes</button>

        </div>

        </form>

    </div>

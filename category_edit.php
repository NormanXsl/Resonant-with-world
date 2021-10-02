<?php
$PAGE_ID = "category edit";
$PAGE_HEADER = "Edit category information";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `category` WHERE `category_id` = ?");
    if ($stmt->execute([$_GET['id']])) {
        if ($stmt->rowCount() == 1) {
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

        // Update product details
        $query = "UPDATE `category` SET `category_name` = ? WHERE `id` = ?";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['category_name'],
            $modifiedCategoryId
        ];
    }
}

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Edit category #<?= $client->client_id ?></h1>
        <p class="mb-4">This page allows you to add a new category to the system</p>
        <?php if (isset($ERROR)): ?>
            <div class="card mb-4 border-left-danger">
                <div class="card-body">Cannot modify the category due to the following error:<br><code>
                        <ul>
                            <li><?= $ERROR ?></li>
                        </ul>
                    </code></div>
            </div>
        <?php endif; ?>
        <form method="post" id="add-category" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <div class="input-group">
                <input type="text" class="form-control" id="clientName" name="firstName" maxlength="64" required value="<?= empty($_POST['category_name']) ? $category->category_name : $_POST['category_name'] ?>">
                </div>
            </div>

<?php require('footer.php'); ?>
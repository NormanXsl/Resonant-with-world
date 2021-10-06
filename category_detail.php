<?php
$PAGE_ID = "category detail";
$PAGE_HEADER = "detail category information";

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

?>
    <div id = page-body>
    <h2 class="title-text">Detail of category #<?= $category->category_id ?></h2>
    <a class="btn btn-blue" href="category_edit.php?id=<?= $category->category_id ?>" ><span class = 'button-text'>Edit this category</span></a>
        <br>
        <div class="form-row">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <div class="input-group">
                    <input type="text" class="form-control" readonly id="category_name" name="category_name" maxlength="255" required value="<?= empty($_POST['category_name']) ? $category->category_name : $_POST['category_name'] ?>">
                </div>
            </div>
        </div>
    </div>

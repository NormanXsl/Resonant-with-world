<?php
$PAGE_ID = "category";
$PAGE_HEADER = "Add Categories";
/** @var PDO $dbh Database connection */

require('TopMenu.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['category_name'])) {
        $query = "INSERT INTO `category` (`category_name`) VALUES (?)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['category_name'],
        ];
        if ($stmt->execute($parameters)) {
            header("Location: category.php");
            exit();
        } else {
            $ERROR = $stmt->errorInfo()[2];
        }
    }
}
?>

    <div id="page-body">

        <h2 class='title-text'>Add new user</h2><br>
        <p class="text">This page allows you to add a new user in the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="post" id="add-users" class="needs-validation">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" maxlength="255" required value="<?= empty($_POST['category_name']) ? "" : $_POST['category_name'] ?>">
            </div>
            <button type="submit" class="btn btn-blue">Add category</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('Footer.php'); ?>
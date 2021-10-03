<?php
$PAGE_ID = "category";
$PAGE_HEADER = "Add Categories";
$PAGE_ALLOWGUEST = false;
/** @var PDO $dbh Database connection */

require('TopMenu.php');

/** @var PDO $dbh Database connection */

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

    <!-- Begin Page Content -->
    <div class="page-body">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Add new user</h1>
        <p class="mb-4">This page allows you to add a new user in the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="post" id="add-users" class="needs-validation">
            <div class="form-group">
                <label for="userFullName">Full name</label>
                <input type="text" class="form-control" id="caategoryName" name="category_name" maxlength="255" required value="<?= empty($_POST['category_name']) ? "" : $_POST['category_name'] ?>">

            <button type="submit" class="btn btn-primary">Add user</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('Footer.php'); ?>
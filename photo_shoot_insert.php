<?php
$PAGE_ID = "photo shoot insert";
$PAGE_HEADER = "Insert Photo Shoot";
/** @var PDO $dbh Database connection */

require('TopMenu.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['photo_shoot_name']) &&
        !empty($_POST['photo_shoot_datetime']) && 
        !empty($_POST['photo_shoot_quote']) &&
        !empty($_POST['client_fk'])){
        $query = "INSERT INTO `photo_shoot` (`photo_shoot_name`, `photo_shoot_description`, `photo_shoot_datetime`, 
        `photo_shoot_quote`, `photo_shoot_other_information`, `client_fk`) VALUES ( ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['photo_shoot_name'],
            empty($_POST['photos_shoot_description']) ? null : $_POST['photos_shoot_description'],
            $_POST['photo_shoot_datetime'],
            $_POST['photo_shoot_quote'],
            empty($_POST['photos_shoot_other_information']) ? null : $_POST['photos_shoot_other_information'],
            $_POST['client_fk']
        ];
        if ($stmt->execute($parameters)) {
            header("Location: photo_shoot.php");
            exit();
        } else {
            $ERROR = $stmt->errorInfo()[2];
        }
    }
}
?>

    <!-- Begin Page Content -->
    <div id="page-body">

        <!-- Page Heading -->
        <h2 class="title-text">Insert new Photo shoot records</h2>
        <br>
        <p class="text">This page allows you to add a new photo shoot to the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="POST" id="insert-photo-shoot" class="needs-validation">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="photo_shoot_name" name="photo_shoot_name" maxlength="255" required value="<?= empty($_POST['photo_shoot_name']) ? "" : $_POST['photo_shoot_name'] ?>">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" id="photo_shoot_description" name="photo_shoot_description" maxlength="255" value="<?= empty($_POST['photo_shoot_description']) ? "" : $_POST['photo_shoot_description'] ?>">
            </div>
            <div class="form-group">
                <label for="Datetime">Datetime</label>
                <input type="text" class="form-control" id="photo_shoot_datetime" name="photo_shoot_datetime" maxlength="255" required value="<?= empty($_POST['photo_shoot_datetime']) ? "" : $_POST['photo_shoot_datetime'] ?>">
            </div>
            <div class="form-group">
                <label for="Quote">Quote</label>
                <input type="text" class="form-control" id="photo_shoot_quote" name="photo_shoot_quote" maxlength="30" required value="<?= empty($_POST['photo_shoot_quote']) ? "" : $_POST['photo_shoot_quote'] ?>">
            </div>
            <div class="form-group">
                <label for="OtherInformation">Other information</label>
                <input type="text" class="form-control" id="photo_shoot_other_information" name="photo_shoot_other_information" maxlength="255" value="<?= empty($_POST['photo_shoot_other_information']) ? "" : $_POST['photo_shoot_other_information'] ?>">
            </div>
            <div class="form-group">
                <label for="Client">Client</label>
                <input type="number" class="form-control" id="client_fk" name="client_fk" maxlength="11" value=<?= empty($_POST['client_fk']) ? "" : $_POST['client_fk'] ?>>
            </div>
            <button type="submit" class="btn btn-blue">Insert new Photo shoot</button>
        </form>
    </div>
    <!-- /.container-fluid -->
    <?php require('Footer.php'); ?>

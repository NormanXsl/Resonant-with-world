<?php
$PAGE_ID = "photo shoot detail";
$PAGE_HEADER = "Photo shoot Details";

require('TopMenu.php');

/** @var PDO $dbh Database connection */
if (isset($_GET['photo_shoot_id'])) {
    $query = "SELECT * FROM `photo_shoot`WHERE `photo_shoot_id`=?";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute([$_GET['photo_shoot_id']])) {
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetchObject();
            $row_fetched = true;

        }
    }
}
if (!(isset($row_fetched) && $row_fetched)) {
    header("Location: photo_shoot.php");
    exit;
}

?>

<html>
<!-- Begin Page Content -->
<div id="page-body">
    <!-- Page Heading -->
    <h2 class="title-text">Details of Photo shoot record #<?= $row->photo_shoot_id ?></h2>
    <a id="editbutton" class="btn btn-blue" href="photo_shoot_update.php?photo_shoot_id=<?= $row->photo_shoot_id ?>"><span class='button-text'>Edit photo shoot detail</span></a>
    <br>

    <div class="form-row">
        <div class="form-group">
            <label for="Name">Record Name</label>
            <div class="input-group">
                <input type="text" class="form-control" readonly id="photo_shoot_name" name="photo_shoot_name" maxlength="255" required value="<?= empty($_POST['photo_shoot_name']) ? $row->photo_shoot_name : $_POST['photo_shoot_name'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <div class="input-group">
                <input type="text" class="form-control" readonly id="photo_shoot_description" name="photo_shoot_description" maxlength="255" required value="<?= empty($_POST['photo_shoot_description']) ? $row->photo_shoot_description : $_POST['photo_shoot_description'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="Datetime">Date&time</label>
            <input type="text" class="form-control" readonly id="photo_shoot_datetime" name="photo_shoot_datetime" maxlength="255" required value="<?= empty($_POST['photo_shoot_datetime']) ? $row->photo_shoot_datetime : $_POST['photo_shoot_datetime'] ?>">
        </div>
        <div class="form-group">
            <label for="Quote">Quote</label>
            <input type="text" class="form-control" readonly id="photo_shoot_quote" name="photo_shoot_quote" maxlength="30" required value="<?= empty($_POST['photo_shoot_quote']) ? $row->photo_shoot_quote : $_POST['photo_shoot_quote'] ?>">
        </div>
        <div class="form-group">
            <label for="OtherInformation">Other information</label>
            <input type="text" class="form-control" readonly id="photo_shoot_other_information" name="photo_shoot_other_information" maxlength="64" required value="<?= empty($_POST['photo_shoot_other_information']) ? $row->photo_shoot_other_information : $_POST['photo_shoot_other_information'] ?>">
        </div>
        <div class="form-group">
            <label for="Client">Client</label>
            <input type="number" class="form-control" id="client_fk" name="client_fk" maxlength="11" value="<?= empty($_POST['client_fk']) ? $row->client_fk: $_POST['client_fk'] ?>">
        </div>
    </div>
</div>
<script src="./js/scripts.js"></script>


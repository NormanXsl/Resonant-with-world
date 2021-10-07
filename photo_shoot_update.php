<?php
ob_start();
$PAGE_ID = "photo shoot update";
$PAGE_HEADER = "Update photo shoot";

require('TopMenu.php');
/** @var $dbh PDO */
if (!isset($_GET['photo_shoot_id'])) {
    // Redirect back to the list page, as id is not provided in the request
    header("Location: photo_shoot.php");
    die();
}
?>
<?php
if (!empty($_POST)) {



    // Process the update record request (if a POST form is submitted)
    $query = "UPDATE `photo_shoot` SET `photo_shoot_name`=:photo_shoot_name,`photo_shoot_description`=:photo_shoot_description,`photo_shoot_datetime`=:photo_shoot_datetime,
        `photo_shoot_quote`=:photo_shoot_quote,`photo_shoot_other_information`=:photo_shoot_other_information,`client_fk`=:client_fk WHERE `photo_shoot_id`=:photo_shoot_id";
    $stmt = $dbh->prepare($query);
    $parameters = [
        'photo_shoot_id' => $_GET['photo_shoot_id'],
        'photo_shoot_name' => $_POST['photo_shoot_name'],
        'photo_shoot_description' => $_POST['photo_shoot_description'],
        'photo_shoot_datetime' => $_POST['photo_shoot_datetime'],
        'photo_shoot_quote' => $_POST['photo_shoot_quote'],
        'photo_shoot_other_information' => $_POST['photo_shoot_other_information'],
        'client_fk' => $_POST['client_fk'],
    ];

    if ($stmt->execute($parameters)) {
        header("Location: photo_shoot.php");
    }
} else {
    // When no POST form is submitted, get the record from database
    $query = "SELECT * FROM `photo_shoot` WHERE `photo_shoot_id`=?";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute([$_GET['photo_shoot_id']])) {
        if ($stmt->rowCount() > 0) {
            $record = $stmt->fetchObject(); ?>
            <div id="page-body">
            <h2 class = 'title-text'>Update Photo Shoot #<?= $record->photo_shoot_id ?></h2>
                <form method="post" id="edit-clients" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="photo_shoot_id">ID</label>
                            <input type="number" class="form-control" id="photo_shoot_id" required value="<?= $record->photo_shoot_id ?>" disabled />
                        </div>
                        <div class="form-group">
                            <label for="photo_shoot_name">Name</label>
                            <input type="text" class="form-control" id="photo_shoot_name" name="photo_shoot_name" required value="<?= $record->photo_shoot_name ?>" />
                        </div>
                        <div class="form-group">
                            <label for="photo_shoot_description">Description</label>
                            <input type="text" class="form-control" id="photo_shoot_description" name="photo_shoot_description" value="<?= $record->photo_shoot_description ?>" />
                        </div>
                        <div class="form-group">
                            <label for="photo_shoot_datetime">Date&Time</label>
                            <input type="text" class="form-control" id="photo_shoot_datetime" name="photo_shoot_datetime" required value="<?= $record->photo_shoot_datetime ?>" />
                        </div>
                        <div class="form-group">
                            <label for="photo_shoot_quote">Quote</label>
                            <input type="text" class="form-control" id="photo_shoot_quote" name="photo_shoot_quote" required value="<?= $record->photo_shoot_quote ?>" />
                        </div>
                        <div class="form-group">
                            <label for="photo_shoot_other_information">Other Information</label>
                            <input type="text" class="form-control" id="photo_shoot_other_information" name="photo_shoot_other_information" value="<?= $record->photo_shoot_other_information ?>" />
                        </div>
                        <div class="form-group">
                            <label for="client_fk">Client</label>
                            <input type="text" class="form-control" id="client_fk" name="client_fk" required value="<?= $record->client_fk ?>" />
                        </div>
                    </div>
                    <div class="row center">
                        <input type="submit" class="btn btn-blue" value="Update" />
                        <button type="submit" value="Update" class="btn btn-blue" onclick="window.location='photo_shoot_detail.php';return false;">Cancel</button>
                    </div>
                </form>
            </div>
<?php } else {
            header("Location: photo_shoot.php");
        }
    }
} ?>
</div>
</body>

</html>


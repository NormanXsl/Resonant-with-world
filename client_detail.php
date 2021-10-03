<?php
$PAGE_ID = "client detail";
$PAGE_HEADER = "Client Details";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `client` WHERE `client_id` = ?");
    if ($stmt->execute([$_GET['id']])) {
        if ($stmt->rowCount() == 1) {
            $client = $stmt->fetchObject();

            $client_fetched = true;

        }
    }
}
if (!(isset($client_fetched) && $client_fetched)) {
    header("Location: client.php");
    exit;
}

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Details of client #<?= $client->client_id ?></h1>

        <div class="form-row">
            <div class="form-group">
                <label for="clientName">First Name</label>
                <div class="input-group">
                <input type="text" class="form-control-plaintext" readonly id="clientName" name="firstName" maxlength="64" required value="<?= empty($_POST['client_fname']) ? $client->client_fname : $_POST['client_fname'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="clientName">Last Name</label>
                <div class="input-group">
                <input type="text" class="form-control-plaintext" readonly id="clientName" name="lastName" maxlength="64" required value="<?= empty($_POST['client_lname']) ? $client->client_lname : $_POST['client_lname'] ?>">
                </div>
            </div>
        </div>

            <div class="form-group">
                <label for="clientName">Address</label>
                <input type="text" class="form-control-plaintext" readonly id="clientName" name="address" maxlength="64" required value="<?= empty($_POST['client_address']) ? $client->client_address : $_POST['client_address'] ?>">
            </div>
            <div class="form-group">
                <label for="clientDescription">Phone</label>
                <textarea class="form-control-plaintext" readonly id="clientDescription" name="phone" maxlength="64"><?= empty($_POST['client_phone']) ? $client->client_phone : $_POST['client_phone'] ?></textarea>
            </div>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>
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
                    <label for="clientFName">First Name</label>
                    <div class="input-group">
                    <input type="text" class="form-control" readonly id="client_fname" name="client_fname" maxlength="255" required value="<?= empty($_POST['client_fname']) ? $client->client_fname : $_POST['client_fname'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="clientLName">Last Name</label>
                    <div class="input-group">
                    <input type="text" class="form-control" readonly id="client_lname" name="client_lname" maxlength="255" required value="<?= empty($_POST['client_lname']) ? $client->client_lname : $_POST['client_lname'] ?>">
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="clientAddress">Address</label>
                    <input type="text" class="form-control" readonly id="client_address" name="client_address" maxlength="255" required value="<?= empty($_POST['client_address']) ? $client->client_address : $_POST['client_address'] ?>">
                </div>
                <div class="form-group">
                    <label for="clientPhone">Phone</label>
                    <textarea class="form-control" readonly id="client_phone" name="client_phone" maxlength="64"><?= empty($_POST['client_phone']) ? $client->client_phone : $_POST['client_phone'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="clientPhone">Email</label>
                    <textarea class="form-control" readonly id="client_email" name="client_email" maxlength="64"><?= empty($_POST['client_phone']) ? $client->client_email : $_POST['client_phone'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="clientPhone">Additional Info</label>
                    <textarea class="form-control" readonly id="client_other_information" name="client_other_information" maxlength="64"><?= empty($_POST['client_phone']) ? $client->client_other_information : $_POST['client_phone'] ?></textarea>
                </div>
                <div class="form-group">
                <input type="checkbox" readonly id="client_subscribed" name="client_subscribed" value="<?= empty($_POST['client_subscribed']) ? $client->client_subscribed : $_POST['client_subscribed'] ?>">
                <label for="sub">Subscribe to our Newsletter and stay updated on new promotions and events!</label>
            </div>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>
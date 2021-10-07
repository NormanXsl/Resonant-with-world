<?php
$PAGE_ID = "client detail";
$PAGE_HEADER = "Client Details";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['client_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `client` WHERE `client_id` = ?");
    if ($stmt->execute([$_GET['client_id']])) {
        if ($stmt->rowCount() > 0) {
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
    <div id="page-body">
        <!-- Page Heading -->
        <h2 class="title-text">Details of client #<?= $client->client_id ?></h2>
        <a id = "editbutton" class="btn btn-blue" href="client_edit.php?client_id=<?= $client->client_id ?>" ><span class = 'button-text'>Edit client detail</span></a>
        <button id = "printpagebutton" onClick="printpage()" class="btn btn-green"><span class = 'button-text'>Generate as PDF</span></button>
        <br>

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
                    <input type="text" class="form-control" readonly id="client_phone" name="client_phone" maxlength="16" required value="<?= empty($_POST['client_phone']) ? $client->client_phone : $_POST['client_phone'] ?>">
                </div>
                <div class="form-group">
                    <label for="clientEmail">Email</label>
                    <input type="text" class="form-control" readonly id="client_email" name="client_email" maxlength="255" required value="<?= empty($_POST['client_phone']) ? $client->client_email : $_POST['client_email'] ?>">
                </div>
                <div class="form-group">
                    <label for="clientAddInfo">Additional Info</label>
                    <input type="text" class="form-control" readonly id="client_other_information" name="client_other_information" maxlength="5000" value="<?= empty($_POST['client_other_information']) ? $client->client_other_information : $_POST['client_other_information'] ?>"/>
                </div>
                <div class="form-group">
                <?php $subscribed = (empty($_POST['client_subscribed']) ? $client->client_subscribed : $_POST['client_subscribed']);
                 if ($subscribed == 0): ?>
                    &#10006;</td>
                <?php $subscribed = (empty($_POST['client_subscribed']) ? $client->client_subscribed : $_POST['client_subscribed']);
                elseif($subscribed == 1): ?>
                    &#10004;</td>
                <?php endif; ?>
                <label for="sub">Subscribe to our Newsletter and stay updated on new promotions and events!</label>
            </div>
    </div>
    <script src="js/scripts.js"></script>

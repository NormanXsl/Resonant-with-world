<?php
$PAGE_ID = "client edit";
$PAGE_HEADER = "Edit client information";

require('TopMenu.php');

/** @var PDO $dbh Database connection */


if (isset($_GET['client_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `client` WHERE `client_id` = ?");
    if ($stmt->execute([$_GET['client_id']])) {
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modifiedClientId = $client->client_id;

    if (!empty($_POST['client_fname']) &&
        !empty($_POST['client_lname']) &&
        !empty($_POST['client_address']) &&
        !empty($_POST['client_phone']) &&
        !empty($_POST['client_email']) &&
        !empty($_POST['client_subscribed']) &&
        !empty($_POST['client_other_information'])) {

        $serverSideErrors = [];


        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();

        $query = "UPDATE `client` SET `client_fname` = ?, `client_lname` = ?, `client_address` = ?, `client_phone` = ?,
         `client_email` = ?,  `client_subscribed` = ?,  `client_other_information` = ? WHERE `client_id` = ?";
        $stmt = $dbh->prepare($query);
        $subscribed = (int)isset($_POST['client_subscribed[0]']);
        if (!isset($_POST['client_other_information'])){
            $client_other_info = "";
        }
        else{
            $client_other_info = $_POST['client_other_information'];
        }
        $parameters = [
            $_POST['client_fname'],
            $_POST['client_lname'],
            $_POST['client_address'],
            $_POST['client_phone'],
            $_POST['client_email'],
            $subscribed,
            $client_other_info,
            $modifiedClientId
        ];

        if ($stmt->execute($parameters)) {
            header("Location: client_detail.php?client_id=" . $modifiedClientId);
        }

    }
}

?>
    <!-- Begin Page Content -->
    <div id="page-body">
        <!-- Page Heading -->
        <h2 class = 'title-text'>Edit client #<?= $client->client_id ?></h2>
        <?php if (isset($ERROR)): ?>
            <div class="card mb-4 border-left-danger">
                <div class="card-body">Cannot modify the client due to the following error:<br><code>
                        <ul>
                            <li><?= $ERROR ?></li>
                        </ul>
                    </code></div>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="client_fname">First Name</label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="client_fname" name="client_fname" maxlength="255" required value="<?= $client->client_fname ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="client_lname">Last Name</label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="client_lname" name="client_lname" maxlength="255" required value="<?= $client->client_lname ?>">
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="client_address">Address</label>
                    <input type="text" class="form-control" id="client_address" name="client_address" maxlength="255" required value="<?= $client->client_address ?>">
                </div>
                <div class="form-group">
                    <label for="client_phone">Phone</label>
                    <input type="text" class="form-control" id="client_phone" name="client_phone" maxlength="16" required value="<?= $client->client_phone ?>">
                </div>
                <div class="form-group">
                    <label for="client_email">Email</label>
                    <input type="text" class="form-control" id="client_email" name="client_email" maxlength="255" required value="<?= $client->client_email ?>">
                </div>
                <div class="form-group">
                    <label for="client_other_information">Additional Info</label>
                    <input type="text" class="form-control" id="client_other_information" name="client_other_information" maxlength="5000" value="<?= $client->client_other_information ?>">
                </div>
                <div class="form-group">
                <?php $subscribed = $client->client_subscribed;
                 if ($subscribed == 0): ?>
                    <input type="checkbox" id="client_subscribed" name="client_subscribed[0]" value=1>
                <?php $subscribed = $client->client_subscribed;
                elseif($subscribed == 1): ?>
                    <input type="checkbox" id="client_subscribed" name="client_subscribed[0]" value=1 checked>
                <?php endif; ?>
                <label for="client_subscribed">Subscribe to our Newsletter and stay updated on new promotions and events!</label>
            </div>
                <button type="submit" class="btn btn-blue">Submit changes</button>
        </form>
    </div>


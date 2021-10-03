<?php
$PAGE_ID = "client";
$PAGE_HEADER = "Add clients";
/** @var PDO $dbh Database connection */

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['client_fname']) &&
        !empty($_POST['client_lname']) && 
        !empty($_POST['client_address']) && 
        !empty($_POST['client_phone']) &&
        !empty($_POST['client_email']) &&
        !empty($_POST['client_subscribed']) &&
        !empty($_POST['client_other_information'])){
        $query = "INSERT INTO `category` (`client_fname`, `client_lname`, `client_address`, 
        `client_phone`, `client_email`, `client_subscribed`, `client_other_information`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['client_fname'],
            $_POST['client_lname'],
            $_POST['client_address'],
            $_POST['client_phone'],
            $_POST['client_email'],
            $_POST['client_subscribed'],
            $_POST['client_other_information']
        ];
        if ($stmt->execute($parameters)) {
            header("Location: client.php");
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
        <h1 class="h3 mb-2 text-gray-800 pb-2">Add new client</h1>
        <p class="mb-4">This page allows you to add a new user in the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="POST" id="add-users" class="needs-validation">
            <div class="form-group">
                <label for="client_fname">First name</label>
                <input type="text" class="form-control" id="client_fname" name="client_fname" maxlength="255" required value="<?= empty($_POST['client_fname']) ? "" : $_POST['client_fname'] ?>">
            </div>
            <div class="form-group">
                <label for="client_lname">Last name</label>
                <input type="text" class="form-control" id="client_lname" name="client_lname" maxlength="255" required value="<?= empty($_POST['client_lname']) ? "" : $_POST['client_lname'] ?>">
            </div>
            <div class="form-group">
                <label for="client_address">Address</label>
                <input type="text" class="form-control" id="client_address" name="client_address" maxlength="255" required value="<?= empty($_POST['client_address']) ? "" : $_POST['client_address'] ?>">
            </div>
            <div class="form-group">
                <label for="client_phone">Phone</label>
                <input type="text" class="form-control" id="client_phone" name="client_phone" maxlength="16" required value="<?= empty($_POST['client_phone']) ? "" : $_POST['client_phone'] ?>">
            </div>
            <div class="form-group">
                <label for="client_email">Email</label>
                <input type="text" class="form-control" id="client_email" name="client_email" maxlength="255" required value="<?= empty($_POST['client_email']) ? "" : $_POST['client_email'] ?>">
            </div>
            <div class="form-group">
                <label for="client_other_information">Additional Info</label>
                <input type="text" class="form-control" id="client_other_information" name="client_other_information" maxlength="500" value="<?= empty($_POST['client_other_information']) ? "" : $_POST['client_other_information'] ?>">
            </div>
            <div class="form-group">
                <input type="int" id="client_subscribed" name="client_subscribed" value="<?= empty($_POST['client_subscribed']) ? 0 : $_POST['client_other_information'] ?>">
                <label for="client_subscribed">Subscribe to our Newsletter and stay updated on new promotions and events!</label>
            </div>
            <button type="submit" class="btn btn-blue">Add Client</button>
        </form>
    </div>
    <!-- /.container-fluid -->

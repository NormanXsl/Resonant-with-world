<?php
$PAGE_ID = "client add";
$PAGE_HEADER = "Add clients";
/** @var PDO $dbh Database connection */

require('TopMenu.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['client_fname']) &&
        !empty($_POST['client_lname']) && 
        !empty($_POST['client_address']) && 
        !empty($_POST['client_phone']) &&
        !empty($_POST['client_email']) &&
        !empty($_POST['client_subscribed']) &&
        !empty($_POST['client_other_information'])){
        $query = "INSERT INTO `client` (`client_fname`, `client_lname`, `client_address`, 
        `client_phone`, `client_email`, `client_subscribed`, `client_other_information`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $subscribed = empty($_POST['client_subscribed[0]']) ? 1 : 0;
        if (is_null($_POST['client_other_information'])){
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
            $client_other_info
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
        <h2 class="title-text">Add new client</h2>
        <br>
        <p class="text">This page allows you to add a new clients to the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="POST" id="add-clients" class="needs-validation">
            <div class="form-group">
                <label for="clientFirstName">First name</label>
                <input type="text" class="form-control" id="client_fname" name="client_fname" maxlength="255" required value="<?= empty($_POST['client_fname']) ? "" : $_POST['client_fname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientLastName">Last name</label>
                <input type="text" class="form-control" id="client_lname" name="client_lname" maxlength="255" required value="<?= empty($_POST['client_lname']) ? "" : $_POST['client_lname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientAddress">Address</label>
                <input type="text" class="form-control" id="client_address" name="client_address" maxlength="255" required value="<?= empty($_POST['client_address']) ? "" : $_POST['client_address'] ?>">
            </div>
            <div class="form-group">
                <label for="clientPhone">Phone</label>
                <input type="text" class="form-control" id="client_phone" name="client_phone" maxlength="16" required value="<?= empty($_POST['client_phone']) ? "" : $_POST['client_phone'] ?>">
            </div>
            <div class="form-group">
                <label for="clientEmail">Email</label>
                <input type="text" class="form-control" id="client_email" name="client_email" maxlength="255" required value="<?= empty($_POST['client_email']) ? "" : $_POST['client_email'] ?>">
            </div>
            <div class="form-group">
                <label for="clientMoreInformation">Additional Info</label>
                <input type="text" class="form-control" id="client_other_information" name="client_other_information" maxlength="5000" value="<?= empty($_POST['client_other_information']) ? "" : $_POST['client_other_information'] ?>">
            </div>
            <div class="form-group">
            <input type="checkbox" id="client_subscribed" name="client_subscribed[0]" value=1>
            <label for="client_subscribed">Subscribe to our Newsletter and stay updated on new promotions and events!</label>
    
        </div>
            <button type="submit" class="btn btn-blue">Add Client</button>
        </form>
    </div>
    <!-- /.container-fluid -->

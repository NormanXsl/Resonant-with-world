<?php
$PAGE_ID = "client add";
$PAGE_HEADER = "Add clients";
$PAGE_ALLOWGUEST = false;
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
        $query = "INSERT INTO `category`(`client_fname`, `client_lname`, `client_address`, 
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
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Add new client</h1>
        <p class="mb-4">This page allows you to add a new user in the system</p>
        <?php if (isset($ERROR)): ?>
        <div class="card mb-4 border-left-danger">
            <div class="card-body">Cannot add new user due to the following error:<br><code><?= $ERROR ?></code></div>
        </div>
        <?php endif; ?>
        <form method="post" id="add-clients" class="needs-validation">
            <div class="form-group">
                <label for="clientFirstName">First name</label>
                <input type="text" class="form-control" id="userFullName" name="fullname" maxlength="64" required value="<?= empty($_POST['fullname']) ? "" : $_POST['fullname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientLastName">Last name</label>
                <input type="text" class="form-control" id="userFullName" name="fullname" maxlength="64" required value="<?= empty($_POST['fullname']) ? "" : $_POST['fullname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientAddress">Address</label>
                <input type="text" class="form-control" id="userFullName" name="fullname" maxlength="64" required value="<?= empty($_POST['fullname']) ? "" : $_POST['fullname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientPhone">Phone</label>
                <input type="text" class="form-control" id="userFullName" name="fullname" maxlength="64" required value="<?= empty($_POST['fullname']) ? "" : $_POST['fullname'] ?>">
            </div>
            <div class="form-group">
                <label for="clientEmail">Email</label>
                <input type="email" class="form-control" id="clientEmail" name="email" maxlength="256" required value="<?= empty($_POST['email']) ? "" : $_POST['email'] ?>">
            </div>
            <div class="form-group">
                <label for="clientMoreInformation">Subscribe</label>
                <input type="text" class="form-control" id="name" name="username" maxlength="64" required value="<?= empty($_POST['username']) ? "" : $_POST['username'] ?>">
            </div>
            <div class="form-group">
                <label for="clientMoreInformation">Additional Info</label>
                <input type="text" class="form-control" id="name" name="username" maxlength="64" required value="<?= empty($_POST['username']) ? "" : $_POST['username'] ?>">
            </div>

            <button type="submit" class="btn btn-primary">Add Client</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('Footer.php'); ?>
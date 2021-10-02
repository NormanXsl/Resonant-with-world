<?php
$PAGE_ID = "client edit";
$PAGE_HEADER = "Edit client information";

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modifiedClientId = $client->client_id;

    if (!empty($_POST['client_fname']) &&
        !empty($_POST['client_lname']) &&
        !empty($_POST['client_address']) &&
        !empty($_POST['client_phone']) &&
        !empty($_POST['client_email']) &&
        !empty($_POST['client_subscribed']) &&
        !empty($_POST['client_other_information'])) {

        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();

        // Update product details
        $query = "UPDATE `client` SET `client_fname` = ?, `client_lname` = ?, `client_address` = ?, `client_phone` = ?,
         `client_email` = ?,  `client_subscribed` = ?,  `client_other_information` = ? WHERE `id` = ?";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['client_fname'],
            $_POST['client_lname'],
            $_POST['client_address'],
            $_POST['client_phone'],
            $_POST['client_email'],
            $_POST['client_subscribed'],
            empty($_POST['client_other_information']) ? null : $_POST['client_other_information'],
            $modifiedClientId
        ];
    }
}

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Edit client #<?= $client->client_id ?></h1>
        <p class="mb-4">This page allows you to add a new client to the system</p>
        <?php if (isset($ERROR)): ?>
            <div class="card mb-4 border-left-danger">
                <div class="card-body">Cannot modify the client due to the following error:<br><code>
                        <ul>
                            <li><?= $ERROR ?></li>
                        </ul>
                    </code></div>
            </div>
        <?php endif; ?>
        <form method="post" id="add-clients" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label for="clientName">First Name</label>
                <div class="input-group">
                <input type="text" class="form-control" id="clientName" name="firstName" maxlength="64" required value="<?= empty($_POST['client_fname']) ? $client->client_fname : $_POST['client_fname'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="clientName">Last Name</label>
                <div class="input-group">
                <input type="text" class="form-control" id="clientName" name="lastName" maxlength="64" required value="<?= empty($_POST['client_lname']) ? $client->client_lname : $_POST['client_lname'] ?>">
                </div>
            </div>
        </div>

            <div class="form-group">
                <label for="clientName">Address</label>
                <input type="text" class="form-control" id="clientName" name="address" maxlength="64" required value="<?= empty($_POST['client_address']) ? $client->client_address : $_POST['client_address'] ?>">
            </div>
            <div class="form-group">
                <label for="clientDescription">Phone</label>
                <textarea class="form-control" id="clientDescription" name="phone" maxlength="64"><?= empty($_POST['client_phone']) ? $client->client_phone : $_POST['client_phone'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-blue">Submit changes</button>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>
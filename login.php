<?php
ob_start(); // To allow setting header when there's already page contents rendered
$PAGE_ID = "login";

// Database connection
require('connection.php');

/** @var PDO $dbh Database connection */

// Process login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        //Run some SQL query here to find that user
        $stmt = $dbh->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");
        if ($stmt->execute([
                $_POST['username'],
                hash('sha256', $_POST['password'])
            ]) && $stmt->rowCount() == 1) {
            $row = $stmt->fetchObject();
            $_SESSION['user_id'] = $row->id;
            //Successfully logged in, redirect user to referer, or index page
            if (empty($_SESSION['referer'])) {
                header("Location: index.php");
            } else {
                header("Location: " . $_SESSION['referer']);
            }
        } else {
            header("Location: login.php?action=error&message=" . urlencode('Your username and/or password is incorrect. Please try again!'));
        }
        exit();
    } else {
        header("Location: login.php?action=error&message=" . urlencode('Please enter both username and password to login!'));
        exit();
    }
}
?>
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Please login</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="loginUsername" name="username" aria-describedby="emailHelp" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="loginUserPassword" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
</body>
</html>
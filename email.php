<?php
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";

require('header.php');

/** @var PDO $dbh Database connection */
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Sending email to users</h1>
        <p class="mb-4">This page allows you to send bulk email to all selected users. </p>
        <form method="post" action="email_send.php" id="send-emails">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Step 1: Select users you would like to send emails to</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php $users_stmt = $dbh->prepare("SELECT * FROM `users`");
                        if ($users_stmt->execute() && $users_stmt->rowCount() > 0): ?>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Send?</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($user = $users_stmt->fetchObject()): ?>
                                    <tr>
                                        <td class="table-cell-center">
                                            <input type="checkbox" name="user_ids[]" class="emails-to-send" value="<?php echo $user->id; ?>" />
                                        </td>
                                        <td><code><?= $user->username ?></code></td>
                                        <td><?= $user->fullname ?></td>
                                        <td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                            <p class="mb-4">There's no user in the database. </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Step 2: Compose the email and send</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="sendmailSubject">Subject</label>
                        <input type="text" class="form-control" id="sendmailSubject" name="subject" placeholder="Latest newsletter!" required>
                    </div>
                    <div class="form-group">
                        <label for="sendmailMessage">Message body</label>
                        <textarea class="form-control" id="sendmailMessage" name="body" rows="5" placeholder="Hi, &#10;&#10;...&#10;&#10;Regards" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send email</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>
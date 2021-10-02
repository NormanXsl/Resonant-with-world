<?php
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";

require('TopMenu.php');

/** @var PDO $dbh Database connection */
?>

        <h1 class="h3 mb-2 text-gray-800 pb-2">Sending email to users</h1>
        <p class="mb-4">This page allows you to send bulk email to all selected users. </p>
        <form method="post" action="email_send.php" id="send-emails">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Step 1: Select users you would like to send emails to</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php $clients = $dbh->prepare("SELECT * FROM `client` WHERE client_subscribed = 1");
                        if ($clients->execute() && $clients->rowCount() > 0): ?>
                            <table class="center table-bordered" width="90%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th><span class = 'text'>Send?</span></th>
                                    <th><span class = 'text'>First Name</span></th>
                                    <th><span class = 'text'>Last Name</span></th>
                                    <th><span class = 'text'>Address</span></th>
                                    <th><span class = 'text'>Phone</span></th>
                                    <th><span class = 'text'>Email Address</span></th>
                                    <th><span class = 'text'>Additional Information</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($client = $clients->fetchObject()): ?>
                                    <tr>
                                        <td align = 'center'>
                                            <input type="checkbox" name="client_ids[]" class="emails-to-send" value="<?php echo $client->client_id; ?>" />
                                        </td>
                                        <td><span class = 'table-text'><?= $client->client_fname ?></span></td>
                                        <td><span class = 'table-text'><?= $client->client_lname ?></span></td>
                                        <td><span class = 'table-text'><?= $client->client_address ?></span></td>
                                        <td><span class = 'table-text'><?= $client->client_phone ?></span></td>
                                        <td><a href="mailto:<?= $client->client_email ?>"><?= $client->client_email ?></a></td>
                                        <td><span class = 'table-text'><?= $client->client_other_information ?></span></td>

                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                            <p class="mb-4">No clients subscribed. </p>
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
                        <textarea class="form-control" id="sendmailMessage" name="body" rows="5" placeholder="Dear Valued Customer, &#10;&#10;...&#10;&#10;Cheers, Resonant With World Pty Ltd." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-blue"><span class = 'button-text'>Send</span></button>
                </div>
            </div>
        </form>
    </div>

<?php require('Footer.php'); ?>
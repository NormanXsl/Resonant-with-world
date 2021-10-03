<?php
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";

require('TopMenu.php');

/** @var PDO $dbh Database connection */
?>
<div id = page-body>
        <h2 class = 'title-text'>Sending email to users</h2>
        <form method="post" action="email_send.php" id="send-emails">
                    <p class="text">Step 1: Select users you would like to send emails to</p>
                <div class="card-body">
                        <?php $clients = $dbh->prepare("SELECT * FROM `client` WHERE client_subscribed = 1");
                        if ($clients->execute() && $clients->rowCount() > 0): ?>
                            <table class="center table-bordered" width="90%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th><span class = 'header-text'>Send?</span></th>
                                    <th><span class = 'header-text'>First Name</span></th>
                                    <th><span class = 'header-text'>Last Name</span></th>
                                    <th><span class = 'header-text'>Phone</span></th>
                                    <th><span class = 'header-text'>Email Address</span></th>
                                    <th><span class = 'header-text'>Additional Information</span></th>
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
                    <h6 class="m-0 font-weight-bold text-primary">Step 2: Compose the email and send</h6>
                    <div class="form-group">
                        <label for="sendmailSubject">Subject</label>
                        <input type="text" class="form-control" id="sendmailSubject" name="subject" placeholder="Latest newsletter!" required>
                    </div>
                    <div class="form-group">
                        <label for="sendmailMessage">Message body</label>
                        <textarea style="height:120px" class="form-control" id="sendmailMessage" name="body" rows="5" placeholder="Dear Valued Customer, &#10;&#10;...&#10;&#10;Cheers, Resonant With World Pty Ltd." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-blue"><span class = 'button-text'>Send</span></button>
        </form>
    </div>

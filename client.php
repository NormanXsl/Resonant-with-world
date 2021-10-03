<?php
$PAGE_ID = "client";
$PAGE_HEADER = "Clients";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>

    <div id = page-body>
            <h2 class = 'title-text'>List of Clients
                <a href="client_add.php" class = 'btn btn-green'>
                <span class="button-text text-align-right">Add New Client</span>
                </a>
            </h2><br>
            <p class = 'text'>The table below shows all the clients in the database.</p>                                   

        <?php $clients = $dbh->prepare("SELECT * FROM `client`");
                    if ($clients->execute() && $clients->rowCount() > 0): ?>
                    <form method="post" action="client_delete.php">
                        <table class = 'center table-bordered' width="99%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>First Name</span></th>
                                <th><span class = 'header-text'>Last Name</span></th>
                                <th><span class = 'header-text'>Address</span></th>
                                <th><span class = 'header-text'>Phone</span></th>
                                <th><span class = 'header-text'>Email Address</span></th>
                                <th><span class = 'header-text'>Subscribed?</span></th>
                                <th><span class = 'header-text'>Additional Info</span></th>
                                <th><span class = 'header-text'>Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($client = $clients->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $client->client_id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_fname ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_lname ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_address ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_phone ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_email ?></code></span></td>
                                    <td align = 'center'><span class = 'table-text'><code><?= $client->client_subscribed ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $client->client_other_information ?></code></span></td>
                                    <td align = 'center'>
                                            <a class="btn btn-green" href="client_detail.php?id=<?= $client->client_id ?>" ><span class = 'button-text'>View</span></a>
                                            <a class="btn btn-blue" href="client_edit.php?id=<?= $client->client_id ?>" ><span class = 'button-text'>Edit</span></a>
                                            <button type="submit" onClick='return confirm("Are you sure you want to delete this client?")' class = 'btn btn-red' name="client_id" value="<?= $client->client_id ?>"><span class = 'button-text'>Delete</span></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </form>
                    <?php else: ?>
                        <p class="text">There are no other client information in the database. </p>
                    <?php endif; ?>
    </div>

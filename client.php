<?php
$PAGE_ID = "client";
$PAGE_HEADER = "Clients";

require('TopMenu.php'); ?>

    <div id = page-body>
            <h2 class = 'title-text'>List of Categories
                <a href="client_add.php" class = 'add-button'>
                <span class="button-text text-align-right">Add New Client</span>
                </a>
            </h2><br>
            <p class = 'text'>The table below shows all the categories of the products stored in the database.</p>                                   

        <?php $clients = $dbh->prepare("SELECT * FROM `client`");
                    if ($clients->execute() && $clients->rowCount() > 0): ?>
                        <table class = 'center table-bordered' width="99%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'text'>ID</span></th>
                                <th><span class = 'text'>First Name</span></th>
                                <th><span class = 'text'>Last Name</span></th>
                                <th><span class = 'text'>Address</span></th>
                                <th><span class = 'text'>Phone</span></th>
                                <th><span class = 'text'>Email Address</span></th>
                                <th><span class = 'text'>Subscribed?</span></th>
                                <th><span class = 'text'>Additional Info</span></th>
                                <th><span class = 'text'>Actions</span></th>
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
                                            <button type="submit" class = 'btn btn-red' name="client_id" value="<?= $client->client_id ?>"><span class = 'button-text'>Delete</span></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="mb-4">There are no other client information in the database. </p>
                    <?php endif; ?>
    </div>
</body>
</html>
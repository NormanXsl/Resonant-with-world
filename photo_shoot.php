
<?php
$PAGE_ID = "photo-shoot";
$PAGE_HEADER = "Photo Shoot";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>

<div id=page-body>
    <h2 class='title-text'>List of photo shoot records
        <a href="photo_shoot_insert.php" class='btn btn-green'>
            <span class="button-text text-align-right">Add New Photo shoot</span>
        </a>
    </h2><br>
    <p class='text'>The table below shows all the photo shoot records in the database.</p>
    <?php
    $query = "SELECT * FROM `photo_shoot`;";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute()) : ?>
        <form method="POST" action="photo_shoot_delete.php">
            <table class='center table-bordered' width="99%" cellspacing="0">
                <thead>
                    <tr>
                        <th><span class='header-text'>ID</span></th>
                        <th><span class='header-text'>Name</span></th>
                        <th><span class='header-text'>Description</span></th>
                        <th><span class='header-text'>Datetime</span></th>
                        <th><span class='header-text'>Quote</span></th>
                        <th><span class='header-text'>Other information</span></th>
                        <th><span class='header-text'>Client</span></th>
                        <th style="width: 300px;"><span class='header-text'>Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $stmt->fetchObject()) : ?>
                        <tr>
                            <td align='center'><span class='table-text'><?= $row->photo_shoot_id ?></span></td>
                            <td><span class='table-text'><code><?= $row->photo_shoot_name ?></code></span></td>
                            <td><span class='table-text'><code><?= $row->photo_shoot_description ?></code></span></td>
                            <td><span class='table-text'><code><?= $row->photo_shoot_datetime ?></code></span></td>
                            <td><span class='table-text'><code><?= $row->photo_shoot_quote ?></code></span></td>
                            <td><span class='table-text'><code><?= $row->photo_shoot_other_information ?></code></span></td>
                            <td align='center'><span class='table-text'><code><?= $row->client_fk ?></code></span></td>
                            <td align='center'>
                                <a class="btn btn-green" href="photo_shoot_detail.php?photo_shoot_id=<?= $row->photo_shoot_id ?>"><span class='button-text'>View</span></a>
                                <a class="btn btn-blue" href="photo_shoot_update.php?photo_shoot_id=<?= $row->photo_shoot_id ?>"><span class='button-text'>Update</span></a>
                                <button type="submit" onClick='return confirm("Are you sure you want to delete this client?")' class='btn btn-red' name="photo_shoot_id" value="<?= $row->photo_shoot_id ?>"><span class='button-text'>Delete</span></button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    <?php else : ?>
        <p class="text">There are no other photo shoot information in the database. </p>
    <?php endif; ?>
</div>
<a class="btn btn-blue" href="photo_shoot_code.php" ><span class = 'button-text'>Click to see code</span></a>

<?php require('Footer.php'); ?>


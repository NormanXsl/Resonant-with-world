<?php
$PAGE_ID = "all tables";
$PAGE_HEADER = "Show All Tables";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>
<div id = page-body>
<a class="btn btn-blue" href="documentation.php" ><span class = 'button-text'>Back to Documentation</span></a> <br>
    <h2 class = 'title-text'>Table of Clients
            </h2><br>

        <?php $clients = $dbh->prepare("SELECT * FROM `client`");
                    if ($clients->execute() && $clients->rowCount() > 0): ?>
            <h3>There are <?php echo $clients->rowCount() ?> rows</h3>                   
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
                                <th style="width: 200px;"><span class = 'header-text'>Additional Info</span></th>
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
                                    <td align = 'center'>
                                        <?php if ($client->client_subscribed == 0): ?>
                                            &#10006;</td>
                                        <?php elseif($client->client_subscribed == 1): ?>
                                            &#10004;</td>
                                        <?php endif; ?>
                                    <td><span class = 'table-text'><code><?= $client->client_other_information ?></code></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text">There are no other client information in the database. </p>
                    <?php endif; ?>
   <br>

   <h2 class = 'title-text'>Table of Categories
            </h2><br>

        <?php $categories = $dbh->prepare("SELECT * FROM `category`");
                    if ($categories->execute() && $categories->rowCount() > 0): ?>
            <h3>There are <?php echo $categories->rowCount() ?> rows</h3>
                        <table class = 'center table-bordered' width="60%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>Category Name</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($category = $categories->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $category->category_id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $category->category_name ?></code></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="text">There are no other categories in the database. </p>
                    <?php endif; ?>


    <h2 class='title-text'>Table of photo shoot records
    </h2><br>
    <?php
    $query = "SELECT * FROM `photo_shoot`;";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute()) : ?>
        <h3>There are <?php echo $stmt->rowCount() ?> rows</h3>
            <table class='center table-bordered' width="99%" cellspacing="0">
                <thead>
                    <tr>
                        <th><span class='header-text'>ID</span></th>
                        <th><span class='header-text'>Name</span></th>
                        <th><span class='header-text'>Description</span></th>
                        <th><span class='header-text'>Datetime</span></th>
                        <th><span class='header-text'>Quote</span></th>
                        <th><span class='header-text'>Other information</span></th>
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
    <?php else : ?>
        <p class="text">There are no other photo shoot information in the database. </p>
    <?php endif; ?>


    <h2 class = 'title-text'>Table of Products
            </h2><br>

        <?php $products = $dbh->prepare("SELECT * FROM `product`");
                    if ($products->execute() && $products->rowCount() > 0): ?>
            <h3>There are <?php echo $products->rowCount() ?> rows</h3>
                        <table class = 'center table-bordered' width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>Product UPC</span></th>
                                <th><span class = 'header-text'>Product Name</span></th>
                                <th><span class = 'header-text'>Product Price</span></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($product = $products->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $product->product_id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $product->product_UPC ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $product->product_name ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $product->product_price ?></code></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="text">There are no other products in the database. </p>
                    <?php endif; ?>


        <h2 class = 'title-text'>Table of Product Images
            </h2><br>

        <?php $product_images = $dbh->prepare("SELECT * FROM `product_image`");
                    if ($product_images->execute() && $product_images->rowCount() > 0): ?>
            <h3>There are <?php echo $product_images->rowCount() ?> rows</h3>
                        <table class = 'center table-bordered' width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>Product Image Filename</span></th>
                                <th><span class = 'header-text'>Product fk</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($product_image = $product_images->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $product_image->image_id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $product_image->product_image_filename ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $product_image->product_fk ?></code></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="text">There are no other product images in the database. </p>
                    <?php endif; ?>

    <h2 class = 'title-text'>Table of Administrator Users
            </h2><br>

        <?php $users = $dbh->prepare("SELECT * FROM `users`");
                    if ($users->execute() && $users->rowCount() > 0): ?>
            <h3>There are <?php echo $users->rowCount() ?> rows</h3>
                        <table class = 'center table-bordered' width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>Username</span></th>
                                <th><span class = 'header-text'>Password</span></th>
                                <th><span class = 'header-text'>Email</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($user = $users->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $user->id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $user->username ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $user->password ?></code></span></td>
                                    <td><span class = 'table-text'><code><?= $user->email ?></code></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="text">There are no other product images in the database. </p>
                    <?php endif; ?> 
                    
                    
                    <h2 class = 'title-text'>Table of product categories
            </h2><br>

        <?php $product_categories = $dbh->prepare("SELECT * FROM `product_category`");
                    if ($product_categories->execute() && $product_categories->rowCount() > 0): ?>
            <h3>There are <?php echo $product_categories->rowCount() ?> rows</h3>                   
                        <table class = 'center table-bordered' width="99%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>Category ID</span></th>
                                <th><span class = 'header-text'>Product ID</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($product_category = $product_categories->fetchObject()): ?>
                                <tr>
                                    <td align = 'center'><span class = 'table-text'><?= $product_category->category_fk ?></span></td>
                                    <td align = 'center'><span class = 'table-text'><?= $product_category->product_fk ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text">There are no other product categories in the database. </p>
                    <?php endif; ?>
   <br>
    </div>
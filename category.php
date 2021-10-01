<?php
$PAGE_ID = "category";
$PAGE_HEADER = "Product Categories";
$PAGE_ALLOWGUEST = false;
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>

    <section id="one">
    <div id = page-body>
            <h2 class = 'title-text'>List of Categories
                <a href="category_add.php" class = 'add-button'>
                <span class="button-text text-align-right">Add New Category</span>
                </a>
            </h2><br>
            <p class = 'text'>The table below shows all the categories of the products stored in the database.</p>                                   

        <?php $categories = $dbh->prepare("SELECT * FROM `category`");
                    if ($categories->execute() && $categories->rowCount() > 0): ?>
                        <table class = 'center table-bordered' width="60%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'text'>ID</span></th>
                                <th><span class = 'text'>Category Name</span></th>
                                <th><span class = 'text'>Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($category = $categories->fetchObject()): ?>
                                <tr>
                                    <td><span class = 'text'><?= $category->category_id ?></span></td>
                                    <td><span class = 'text'><code><?= $category->category_name ?></code></span></td>
                                    <td align = 'center'>
                                            <a class="edit-button" href="category_edit.php?id=<?= $category->category_id ?>" ><span class = 'button-text'>Edit</span></a>
                                            <button type="submit" class = 'delete-button' name="cateogry_id" value="<?= $category->category_id ?>"><span class = 'button-text'>Delete</span></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="mb-4">There are no other categories in the database. </p>
                    <?php endif; ?>
    </div>
        </section>
<?php require('Footer.php'); ?>
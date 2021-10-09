<?php
$PAGE_ID = "category";
$PAGE_HEADER = "Product Categories";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>

    <div id = page-body>
            <h2 class = 'title-text'>List of Categories
                <a href="category_add.php" class = 'btn btn-green'>
                <span class="button-text text-align-right">Add New Category</span>
                </a>
            </h2><br>
            <p class = 'text'>The table below shows all the categories of the products stored in the database.</p>                                   

        <?php $categories = $dbh->prepare("SELECT * FROM `category`");
                    if ($categories->execute() && $categories->rowCount() > 0): ?>
                    <form method="post" action="category_delete.php">
                        <table class = 'center table-bordered' width="60%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>ID</span></th>
                                <th><span class = 'header-text'>Category Name</span></th>
                                <th><span class = 'header-text'>Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($category = $categories->fetchObject()): ?>
                                <tr>
                                    <td><span class = 'table-text'><?= $category->category_id ?></span></td>
                                    <td><span class = 'table-text'><code><?= $category->category_name ?></code></span></td>
                                    <td align = 'center'>
                                            <a class="btn btn-green" href="category_detail.php?category_id=<?= $category->category_id ?>" ><span class = 'button-text'>View</span></a>
                                            <a class="btn btn-blue" href="category_edit.php?category_id=<?= $category->category_id ?>" ><span class = 'button-text'>Edit</span></a>
                                            <button type="submit" onClick='return confirm("Are you sure you want to delete this category?")' class = 'btn btn-red' name="category_id" value="<?= $category->category_id ?>"><span class = 'button-text'>Delete</span></button>

                                        </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                        </form>

                    <?php else: ?>
                        <p class="text">There are no other categories in the database. </p>
                    <?php endif; ?>
    
        <a class="btn btn-blue" href="category_code.php" ><span class = 'button-text'>Click to see code</span></a>
    </div>
<?php
$PAGE_ID = "documentation";
$PAGE_HEADER = "Documentation";
/** @var PDO $dbh Database connection */

require('TopMenu.php'); ?>

    <div id = page-body>
    <h3>Developers of this web app are listed as follows: </h3>
    <p class = "text">- Name: Sovathanak Meas, Student ID: 29400090</p><br>
    <p class = "text">- Name: Shilong Xiao, Student ID: 30257263</p><br>
    <p class = "text">- Name: Tianyao Ma, Student ID: 31071988</p>
    
    <h3>Database Credentials: </h3>
    <p class = "text">Database Name: <?php echo $db_name?></p><br>
    <p class = "text">Database Username: <?php echo $db_username?></p><br>
    <p class = "text">Database Password: <?php echo $db_passwd?></p><br>

    <h3>SQL links: </h3>
    <p class = "text">Database Schema Link: <a class ="btn btn-blue" href = "https://git.infotech.monash.edu/fit2104-cl/fit2104-2021-s2/pair_lab04_lee_05/fit2104_assignment_2/blob/master/sql/schema.sql">
    <span class = 'button-text'>Schema</span></a></p><br>
    <p class = "text">Demo Data Link: <a class ="btn btn-blue" href = "https://git.infotech.monash.edu/fit2104-cl/fit2104-2021-s2/pair_lab04_lee_05/fit2104_assignment_2/blob/master/sql/data.sql">
    <span class = 'button-text'>Data</span></a></p><br>

    <h3>Submission Date: </h3>
    <p class = "text"> 10/10/2021</p>

    <h3>Link to the repository: </h3>
    <a class ="btn btn-blue" href = "https://git.infotech.monash.edu/fit2104-cl/fit2104-2021-s2/pair_lab04_lee_05/fit2104_assignment_2"><span class = 'button-text'>Go to repository</span></a>
    <br>

    <h3>Credentials to access the system: </h3>
    <p class = "text">1. Username: Anna</p><p class = "text">Password: Anna</p>
    <br>
    <h3>Click button below to see all tables in database</h3>
    <a class="btn btn-blue" href="all_tables_documentation.php" ><span class = 'button-text'>Tables</span></a>

    <h3>Table of Student Contribution</h3>
    <table class = 'left table-bordered' width="99%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><span class = 'header-text'>Web Page</span></th>
                                <th><span class = 'header-text'>Student Responsible</span></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Database schema (Basic)</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas, Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>CSS</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao, Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Client Page (Basic)</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Client Page (Distinction)</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Category Page</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Documentation Page</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Send Email Page</span></td>
                                    <td><span class = 'table-text'>Sovathanak Meas</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Product Page</span></td>
                                    <td><span class = 'table-text'>Tianyao Ma</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Mutlitple product edit Page</span></td>
                                    <td><span class = 'table-text'>Tianyao Ma</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Product Page (High Distinction)</span></td>
                                    <td><span class = 'table-text'>Tianyao Ma</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Home/Main Page</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Top  menu</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Footer</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Photoshoot Page</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Images Page(Not fully done)</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                                <tr>
                                    <td align = 'left'><span class = 'table-text'>Login/Logout page</span></td>
                                    <td><span class = 'table-text'>Shilong Xiao</span></td>
                                </tr>
                            </tbody>
                        </table>

    </div>
    <?php require('Footer.php'); ?>

<?php

use Mkshao\Web\Controllers\UserController;
use Mkshao\Web\Database\Db;
use Mkshao\Web\Models\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <table class=" table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birdth</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>update</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $users = [];
                if ($db->DBconnection) {
                    $query = "SELECT * FROM users";
                    $statement = $db->connection->prepare($query);
                    $statement->execute();
                    $users = $statement->fetchAll(PDO::FETCH_CLASS, 'Mkshao\Web\Models\User');
                } else {
                    if (isset($_SESSION["users"])) {
                        $users = $_SESSION["users"];
                    }
                }

                if ($db->DBconnection) {

                    // Loop through users and generate table rows
                    foreach ($users as $user) {
                        echo '<tr>';
                        echo '<td><a href=index.php?page=showUser&id=' . $user->id . '" title="#">' . $user->id . ' </a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user->id . '" title="#">' . $user->name . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user->id . '" title="#">' . $user->year_of_birth . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user->id . '" title="#">' . $user->created_at . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user->id . '" title="#">' . $user->updated_at . '</a></td>';
                        echo '<td><a href="index.php?page=editUser&id=' . $user->id . '" title="#">EDIT</a></td>';
                        //  echo '<td><a href="index.php?page=editUser&id='. $user->id .'" title="#">DELETE</a></td>';
                        echo '</tr>';
                    }
                } else {
                    foreach ($users as $user) {
                        echo '<tr>';
                        echo '<td><a href=index.php?page=showUser&id=' . $user['id'] . '" title="#">' . $user['id'] . ' </a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user['id'] . '" title="#">' . $user['name'] . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user['id'] . '" title="#">' . $user['year_of_birth'] . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user['id'] . '" title="#">' . $user['created_at'] . '</a></td>';
                        echo '<td><a href="index.php?page=showUser&id=' . $user['id'] . '" title="#">' . $user['updated_at'] . '</a></td>';
                        echo '<td><a href="index.php?page=editUser&id=' . $user['id'] . '" title="#">EDIT</a></td>';
                        //  echo '<td><a href="index.php?page=editUser&id='. $user->id .'" title="#">DELETE</a></td>';
                        echo '</tr>';
                    }
                }
                ?>


                </tbody>
            </table>
            <a href="index.php?page=createUser"> <input type="button" class="btn btn-primary w-100"
                                                        value="CREATE NEW USER + "></a>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
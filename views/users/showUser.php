<?php

use  Mkshao\Web\Models\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$userId = null;
if (isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {

    $userId = $_GET['id'];
    $newUser = new User();
    $getUser = $newUser->showUserById($userId);

} else {
    header("Location: index.php");
}


?>


<div class="container pt-5">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <form action="/web/routes.php/editUser/<?= $userId ?>" method="post">
                <div class="form-group">
                    <label for="name">name :</label><br>
                    <input type="text" disabled value="<?= $getUser['name'] ?>" id="name" class="form-control"
                           name="name" placeholder="your name">
                </div>
                <div class="form-group">
                    <label for="birthday">birthday :</label><br>
                    <input type="date" id="birthday" disabled value="<?= $getUser['year_of_birth'] ?>"
                           class="form-control" name="birthday" placeholder="your birthday">
                </div>
                <br><br>

                <a href="/web/index.php"> <input type="button" class="btn btn-primary w-100"
                                                 value="GO BACK TO THE LIST"></a>
            </form>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

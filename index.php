<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//session_destroy();
require 'vendor/autoload.php';
require "views/fixed/head.php";

use Mkshao\Web\Controllers\UserController;
use Mkshao\Web\Database\Db;
use Mkshao\Web\Models\User;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$db = new Db();

if (!isset($_GET['page'])) {
    include "views/home.php";
} else if (($_GET['page']) == "editUser") {
    include "views/users/editUser.php";
} else if (($_GET['page']) == "showUser") {
    include "views/users/showUser.php";
} else if (($_GET['page']) == "routes") {
    include "routes.php";
} else if (($_GET['page']) == "createUser") {
    include "views/users/createUser.php";
} else {
    include "views/home.php";
}


require "views/fixed/footer.php";
?>

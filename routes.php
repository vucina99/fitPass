<?php
require_once 'vendor/autoload.php';

use Mkshao\Web\Controllers\UserController;
use Mkshao\Web\Database\Db;
use Mkshao\Web\Models\User;
use Mkshao\Web\Controllers\HomeController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$routes = [
    '/web/index.php?page=routes&editUser=([0-9]+)' => 'UserController/editUser',
    '/web/index.php?page=routes&createUser' => 'UserController/createUser',

];


$url = $_SERVER['REQUEST_URI'];
$newUrl = preg_replace('~[\\\\/:*?"<>|=&]~', '/', $url);
$counter = 0;
foreach ($routes as $route => $controllerAction) {
    $newRoute = $new_str = preg_replace('~[\\\\/:*?"<>|=&]~', '/', $route);

    if (preg_match("#^$newRoute$#", $newUrl)) {

        list($controller, $action) = explode('/', $controllerAction);
        $explodeUrl = explode('=', $url);
        $id = $explodeUrl[count($explodeUrl) - 1];
        $controllerClass = "Mkshao\\Web\\Controllers\\" . $controller;
        $controller = new $controllerClass();

        $controller->$action($id);


        $counter++;
        break;
    }
}
if ($counter == 0) {
    header("Location: index.php");
}

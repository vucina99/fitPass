<?php


namespace Mkshao\Web\Controllers;

use  Mkshao\Web\Models\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class UserController
{


    public function about()
    {
        echo "about controller index";
    }

    public function show()
    {
        echo "user * " . func_get_args()[0];
    }

    public function editUser($id)
    {
        $name = $_POST['name'];
        $birthDay = $_POST['birthday'];
        $regexName = "/^[A-Z][a-z]+ [A-Z][a-z]+$/";
        $regexBirthDay = "/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";


        if (preg_match($regexName, $name) && preg_match($regexBirthDay, $birthDay)) {
            $createUserArray = [
                'name' => $name,
                'year_of_birth' => $birthDay,
                "updated_at" => date("Y-m-d H:i:s")
            ];
            $newUser = new User();
            $newUser->updateUser($createUserArray, func_get_args()[0]);
            header("Location: index.php");

        } else {
            $_SESSION['error'] = "Please fill full name with a capital letter of the first and last name and birthday must be  valid";

            header('Location: ' . $_SERVER['HTTP_REFERER']);

        }

    }


    public function createUser()
    {

        $name = $_POST['name'];
        $birthDay = $_POST['birthday'];
        $regexName = "/^[A-Z][a-z]+ [A-Z][a-z]+$/";
        $regexBirthDay = "/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";


        if (preg_match($regexName, $name) && preg_match($regexBirthDay, $birthDay)) {
            $createUserArray = [
                'name' => $name,
                'year_of_birth' => $birthDay,
                "updated_at" => date("Y-m-d H:i:s"),
                "created_at" => date("Y-m-d H:i:s")
            ];
            $newUser = new User();
            $newUser->createUser($createUserArray);
            header("Location: index.php");
        } else {
            $_SESSION['error'] = "Please fill full name with a capital letter of the first and last name and birthday must be  valid";

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }

}
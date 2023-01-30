<?php

use PHPUnit\Framework\TestCase;
use  Mkshao\Web\Models\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

final class UserTest extends TestCase
{
    // test the creation of a new user
    public function testCreateUser()
    {
        // create a new user object
        $user = new User();

        $arrayUser = ['name' => "Pera Peric", 'year_of_birth' => "2023-01-18"];

        // save the user to the database
        $createAndGetId = $user->createUser($arrayUser);


        // retrieve the user from the database
        $foundUser = $user->showUserById($createAndGetId);

        // assert that the found user is the same as the created user
        $this->assertEquals($arrayUser['name'], $foundUser['name']);
        $this->assertEquals($arrayUser['year_of_birth'], $foundUser['year_of_birth']);

    }

    // test the update of a user
    public function testUpdateUser()
    {
        // create a new user object
        $user = new User();
        $arrayUserCreate = ['name' => "Vuk Zdravkovic", 'year_of_birth' => "2023-01-20"];

        // save the user to the database
        $createAndGetId = $user->createUser($arrayUserCreate);

        // retrieve the user from the database
        $foundUser = $user->showUserById($createAndGetId);

            $arrayUserUpdate = ['name' => "Zoran Zokic", 'year_of_birth' => "2000-01-10"];

        // update the user
        $user->updateUser($arrayUserUpdate, $createAndGetId);

        // retrieve the user from the databasesssssss
        $foundUser = $user->showUserById($createAndGetId);

        // assert that the found user is the same as the created user
        $this->assertEquals($arrayUserUpdate['name'], $foundUser['name']);
        $this->assertEquals($arrayUserUpdate['year_of_birth'], $foundUser['year_of_birth']);

    }


}

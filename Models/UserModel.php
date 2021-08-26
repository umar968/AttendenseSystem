<?php

class UserModel
{

    function __construct()
    {
    }
    function login($username, $password)
    {
        //Login operations will be performed here
        echo $username . '<br>';
        echo $password . '<br>';
        return true;
    }
}

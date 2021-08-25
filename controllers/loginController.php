<?php

class Login extends Controller
{
    function __construct()
    {
        echo "<br>Login Controller<br>";
    }
    function render()
    {
        echo "This should be render without action getting passed";
    }
}

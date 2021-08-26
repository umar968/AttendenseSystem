<?php
class Controller
{
    function __construct()
    {
        $this->View = new View();
    }
    function loadModel($ModelName)
    {
        require "Models/$ModelName.php";
        $this->Model = new $ModelName();
    }
}

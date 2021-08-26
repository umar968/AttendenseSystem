<?php
class View
{

    function __construct()
    {
    }
    function render($dirName, $ViewName)
    {
        require 'Views/' . $dirName . '/' . $ViewName . 'View.php';
    }
}

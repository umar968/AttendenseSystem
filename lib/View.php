<?php
class View
{
    function render($dirName, $ViewName)
    {
        require 'Views/header.php';
        require 'Views/' . $dirName . '/' . $ViewName . 'View.php';
        require 'Views/footer.php';
    }
}

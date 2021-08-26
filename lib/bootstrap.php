<?php

class Bootstrap
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $config = parse_ini_file('config/config.ini');
        Session::init();
        print_r($url);
        if (empty($url[0])) {
            //url is empty so redirect to Home page
            echo "url is empty";
        } else {
            $controller = "controllers/" . $url[0] . "Controller.php";

            if (file_exists($controller)) {
                //Controller Exists
                require $controller;
                $controller = new $url[0];
                if (!empty($url[1])) {
                    //hence method is being passed
                    if (method_exists($controller, $url[1])) {
                        if (!empty($url[2])) {
                            //hence parameter is also passed
                            echo "parameter passed";
                            $controller->{$url[1]}($url[2]);
                        } else {
                            //only controller and method no parameter                            
                            $controller->{$url[1]}();
                        }
                    } else {
                        //Method is passed but it doesnot exist in controller
                        echo "Sorry Method passed doesnot exist";
                    }
                } else {
                    //No method is passed only controller
                    echo "Method is not passed";
                    $controller->render();
                }
            } else {
                //Defined Controller Doesnot Exist so move to Home Page
                echo "No controller exists" . $controller;
            }
        }
        // Session::destroy();
    }
}

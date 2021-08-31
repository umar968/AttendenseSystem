<?php

class Bootstrap
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        Session::init();

        if (empty($url[0])) {
            //url is empty so redirect to Home page

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

                            $controller->{$url[1]}($url[2]);
                        } else {
                            //only controller and method no parameter                            
                            $controller->{$url[1]}();
                        }
                    } else {
                        //Method is passed but it doesnot exist in controller

                    }
                } else {
                    //No method is passed only controller

                    $controller->render();
                }
            } else {
                //Defined Controller Doesnot Exist so move to Home Page

            }
        }
        // Session::destroy();
    }
}

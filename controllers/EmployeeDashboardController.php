<?php
class EmployeeDashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (!Session::get('loggedIn')) {
            header("location:User");
        }
    }
    function render()
    {
        $this->View->render('EmployeeDashboard', 'EmployeeDashboard');
    }
}

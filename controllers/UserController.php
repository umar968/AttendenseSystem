<?php

class User extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function render()
    {
        $this->View->render('login', 'login');
    }
    function login()
    {

        $this->loadModel('UserModel');
        if ($this->Model->login($_POST['username'], $_POST['password'])) {
            //Loggedin Go to Dashboard
            Session::set('loggedIn', true);
            Session::set('loginError', null);
            if ($this->Model->isEmployee()) {
                header('location:../EmployeeDashboard');
            } else {
                header('location:../HrDashboard');
            }
        } else {
            //Invalid Credentials
            Session::set('loginError', "Invalid Username or Password");
            Session::set('loggedIn', false);
            header('location: ../User');
        }
    }
    function logout()
    {
        Session::set('loggedIn', false);
        Session::set('logginError', '');
        header('location: ../User');
    }
}

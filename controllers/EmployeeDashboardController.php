<?php
class EmployeeDashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (!Session::get('loggedIn')) {
            header("location:User");
        } else {
            $this->UserId = Session::get('UserId');
            $this->getUserData();
        }
    }
    private function getUserData()
    {
        $this->loadModel('UserModel');
        $UserData = $this->Model->getUserData($this->UserId);
        if (gettype($UserData) === "object") {
            $this->View->UserData = $UserData;
        } else {
            echo $UserData;
        }
    }
    function render()
    {
        $this->View->render('EmployeeDashboard', 'EmployeeDashboard');
    }
    function timeIn($UserId)
    {
        echo $UserId;
        $this->Model->timeIn($UserId);
    }
    function timeOut($UserId)
    {
        echo $UserId;
        $this->Model->timeOut($UserId);
    }
}

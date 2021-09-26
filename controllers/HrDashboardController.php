<?php
class HrDashboard extends Controller
{
    function __construct()
    {
        parent::__construct();

        if (!Session::get('loggedIn') || Session::get("role") !== "HrManager") {
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
        $this->View->render('HrDashboard', 'HrDashboard');
    }
    function BossList()
    {
        $this->Model->getBossList();
    }
    function addEmployee()
    {
        $this->Model->addEmployee();
    }
    function getEmployees()
    {
        $this->Model->getEmployees();
    }
    function delEmployee($EmployeeId)
    {
        $this->Model->delEmployee($EmployeeId);
    }
    function editEmployee($EmployeeId)
    {
        $this->Model->editEmployee($EmployeeId);
    }
    function email()
    {
        $this->Model->generateList();
    }

    // function checkStatus($EmployeeId)
    // {
    //     echo $this->Model->checkStatus($EmployeeId);
    // }

    function attendenceReport($month)
    {
        $this->Model->attendenceReport($month);
    }
}

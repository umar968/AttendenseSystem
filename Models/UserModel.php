<?php

class UserModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    function login($username, $password)
    {
        //Login operations will be performed here
        $query = "Select * from Users where UserName='$username' and Password='$password'";
        $result = $this->db->db->query($query);
        if ($result->num_rows == 1) {
            $result = $result->fetch_assoc();
            $UserId = $result['UserId'];

            Session::set('UserId', $UserId);

            return true;
        } else {
            return false;
        }
    }
    function isEmployee()
    {
        $UserId = Session::get('UserId');
        echo $UserId;
        $query = "Select Designation from Designation where EmployeeId=(Select EmployeeId from Employees where UserId='$UserId')";
        $result = $this->db->db->query($query);
        if (!$result) {
            echo "Error in isEmployee" . $this->db->db->error;
            return false;
            die("");
        } else {
            $result = $result->fetch_assoc();
            if ($result['Designation'] == 'Hr Manager') {
                return false;
            } else {
                return true;
            }
        }
    }
    function getUserData($UserId)
    {
        //User Data will be fetched here for display in Dashboard
        $query = "Select * from Employees where UserId='$UserId'";
        $result = $this->db->db->query($query);
        if (!$result) {
            echo "Cannot Fetch Data";
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $UserData = new stdClass();
                $UserData->Name = $row['Name'];
                $UserData->Salary = $row['Salary'];
                $UserData->ProfilePicture = $row['Profile Picture'];
                $UserData->Boss = $row['Boss'];
                $UserData->EmployeeId = $row['EmployeeId'];
                return $UserData;
            } else {
                echo "User Not found";
            }
        }
    }
    function timeIn($UserId)
    {
        //Database Operations for Time In will be here

        //First Check if it is more than 12pm and less than 9pm
        // Get the employee id using UserId 
        //Check if attendence of date is already added
        //Add the attendence

        $maxTime = "20:00:00";
        $minTime = "09:00:00";

        if (time() <= strtotime($maxTime) && time() >= strtotime($minTime)) {
            //Within Time Limits
            $query = "Select EmployeeId from Employees where UserId='$UserId'";
            $result = $this->db->db->query($query);
            if (!$result) {
                echo "Error fetching data 1";
            } else {
                $row = $result->fetch_assoc();
                $EmployeeId = $row['EmployeeId'];
                $Date = date('Y/m/d');

                //Check if Attendence is already marked or not
                $query = "Select Status from Attendence where EmployeeId='$EmployeeId' and Date='$Date'";
                $result = $this->db->db->query($query);

                if (!$result) {
                    echo "Error fetching data 2" . $this->db->db->error;
                } else {
                    if ($result->num_rows > 0) {
                        //Means entry was already made
                        $row = $result->fetch_assoc();
                        $Status = $row['Status'];
                        if ($Status) {
                            echo "Already Marked Present";
                        } else {
                            echo "Already Marked Absent";
                        }
                    } else {
                        //No entry was previously made
                        $timeIn = date('H:i:s');
                        $query = "Insert into Attendence (EmployeeId,Date,TimeIn,Status) values ('$EmployeeId','$Date','$timeIn',true)";
                        $result = $this->db->db->query($query);
                        if (!$result) {
                            echo "Cannot add data" . $this->db->db->error;
                        } else {
                            echo "Congratulations data added succssfully";
                        }
                    }
                }
            }
        } else {
            echo "False";
        }
    }
    function timeOut($UserId)
    {
        //Database operation for time out will be here
        //Check if TimeIn entry was made and Timeout is null
        //Make a timeout entry
        $Date = date('Y/m/d');
        $query = "Select TimeOut from Attendence where EmployeeId=(Select EmployeeId from Employees where UserId='$UserId') and Date='$Date'";
        $result = $this->db->db->query($query);
        if (!$result) {
            echo "Error executing query" . $this->db->db->error;
        } else {
            if ($result->num_rows > 0) {
                //no entry of time in
                $row = $result->fetch_assoc();
                $timeOutStatus = $row['TimeOut'];
                if ($timeOutStatus == null) {
                    $timeOut = date('H:i:s');
                    $query = "Update Attendence Set TimeOut='$timeOut' where EmployeeId=(Select EmployeeId from Employees where UserId='$UserId') and Date='$Date'";
                    $result = $this->db->db->query($query);
                    if (!$result) {
                        echo "Sorry error" . $this->db->db->error;
                    } else {
                        echo "Time out successfully added";
                    }
                } else {
                    echo 'You have already TimeOut';
                }
            } else {
                //no entry of time in
            }
        }
    }
    function getBossList()
    {
        $query = "SELECT Employees.Name FROM Employees INNER JOIN Designation ON Employees.EmployeeId=Designation.EmployeeId where Designation.Designation='Manager';";
        $result = $this->db->db->query($query);
        if (!$result) {
            echo "error" . $this->db->db->error;
        } else {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row['Name']);
            }
            echo json_encode($data);
        }
    }
    function addEmployee()
    {
        $Name = $_POST['Name'];
        $Username = $_POST['UserName'];
        $Department = $_POST['Department'];
        $Salary = $_POST['Salary'];
        $Designation = $_POST['Designation'];
        $ImageName = $_FILES["ProfilePicture"]["name"];
        $Boss = isset($_POST['Boss']) ? $_POST['Boss'] : null;
        $Password = $_POST['Password'];
        $query = "Insert into Users (UserName,Password) values ('$Username','$Password')";
        $result = $this->db->db->query($query);
        if (!$result) {
            echo $this->db->db->error;
            die("Error1");
        } else {
            $query = "INSERT INTO Employees (`UserId`, `Name`, `Salary`, `Profile Picture`, `Boss`,  `Department`) VALUES ((select UserId from Users where  Password='$Password'), '$Name', '$Salary', '$ImageName', '$Boss',  '$Department');";
            $folder = "Images/" . $ImageName;
            $result = $this->db->db->query($query);
            if (!$result) {
                echo $this->db->db->error;
                die("error2");
            } else {

                $query = "Select EmployeeId from Employees where UserId=(select UserId from Users where UserName='$Username' and Password='$Password')";
                $result = $this->db->db->query($query);

                if (!$result) {
                    echo $this->db->db->error;
                    die("error3");
                } else {
                    $result = $result->fetch_assoc();
                    $EmployeeId = $result['EmployeeId'];
                    $query = "Insert into Designation (Designation,EmployeeId) values ('$Designation','$EmployeeId')";
                    $result = $this->db->db->query($query);
                    if (!$result) {
                        echo $this->db->db->error;
                        die("error4");
                    } else {
                        if (move_uploaded_file($_FILES['ProfilePicture']['tmp_name'], $folder)) {
                            header("Location:index.html");
                        } else {
                            die("Cannot upload image");
                        }
                    }
                }
            }
        }
    }
    function getEmployees()
    {
        $query = "Select * from Employees";
        $result = $this->db->db->query($query);
        if (!$result) {
            die($this->db->db->error);
        } else {
            $result = $result->fetch_all();
            echo json_encode($result);
        }
    }
    function delEmployee($EmployeeId)
    {
        $query = "Delete from Attendence where EmployeeId=$EmployeeId";
        $result = $this->db->db->query($query);
        if (!$result) {
            die($this->db->db->error);
        } else {
            $query = "Delete from Users where UserId=(Select UserId from Employees where EmployeeId=$EmployeeId)";
            $result = $this->db->db->query($query);
            echo "hello";

            if (!$result) {

                die($this->db->db->error);
            } else {
                $query = "Delete from Employees where EmployeeId=$EmployeeId";
                $result = $this->db->db->query($query);
                if (!$result) {
                    die($this->db->db->error);
                } else {
                    $query = "Delete from Designation where EmployeeId=$EmployeeId";
                    $result = $this->db->db->query($query);
                    if (!$result) {
                        die($this->db->db->error);
                    } else {
                        echo "Congrats Succesfully deleted";
                    }
                }
            }
        }
    }
    function editEmployee($EmployeeId)
    {
        $Name = $_POST['Name'];
        $Department = $_POST['Department'];
        $Salary = $_POST['Salary'];
        $Boss = isset($_POST['Boss']) ? $_POST['Boss'] : null;
        $query = "Update Employees set Name='$Name', Department='$Department', Salary='$Salary', Boss='$Boss' where EmployeeId=$EmployeeId";
        $result = $this->db->db->query($query);
        if (!$result) {
            die($this->db->db->error);
        } else {
            echo ("Edited");
        }
    }

    function generateList()
    {
        $query = "select Name from Employees where EmployeeId NOT IN (select EmployeeId from Attendence) ";
        $result = $this->db->db->query($query);
        $list = array();
        if (!$result) {
            die("Sorry");
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "<br>" . $row['Name'] . "<br>";
            }
        }
    }
    function checkStatus($EmployeeId)
    {

        $Date = date('Y/m/d');
        $query = "Select * from Attendence where EmployeeId=$EmployeeId and Date=$Date";
        $result = $this->db->db->query($query);
        if (!$result) {
            die("Soory");
        } else {
            if ($result->num_rows > 0) {
                return 1;
            } else {

                return 0;
            }
        }
    }
    function attendenceReport($month)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $minDate = $month . '-00';
        $maxDate = $month . '-31';

        $query = "Select EmployeeId,Date,Status from Attendence where Date between '$minDate' and '$maxDate'";

        $result = $this->db->db->query($query);
        if (!$result) {
            die("Soory");
        } else {
            if ($result->num_rows > 0) {
                $dataArry = array();
                while ($row = $result->fetch_assoc()) {
                    $status = $row['Status'];
                    $date = $row['Date'];
                    $employeeId = $row['EmployeeId'];

                    $query = "Select Name from Employees where EmployeeId=$employeeId";
                    $result = $this->db->db->query($query);
                    if (!$result) {
                        die($this->db->db->error);
                    } else {
                        if ($result->num_rows > 0) {
                            $name = $result->fetch_assoc()['Name'];
                        }
                    }
                    $tempObj = new stdClass();
                    $tempObj->name = $name;
                    $tempObj->date = $date;
                    $tempObj->status = $status;
                    array_push($dataArry, $tempObj);
                    echo json_encode($dataArry);
                }
            } else {
                echo "No record found";
            }
        }
    }
}

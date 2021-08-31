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
}

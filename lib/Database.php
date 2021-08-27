<?php

class Database
{
    function __construct()
    {
        // Create connection
        $this->db = new mysqli('localhost', 'root', 'I1ntelinside@', 'AttendanceSystemDB');
        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

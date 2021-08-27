<a href="./User/logout">Logout</a>
<h2>Employee Dashboard</h2>

<h4>Name:<?php echo $this->UserData->Name ?></h4>

<h4>Salary:<?php echo $this->UserData->Salary ?></h4>

<h4>Profile Picture:<?php echo $this->UserData->ProfilePicture ?></h4>

<h4>Boss:<?php echo $this->UserData->Boss ?></h4>

<h4>Employee Id:<?php echo $this->UserData->EmployeeId ?></h4>

<h3>Mark Time In</h3>
<button onclick="handleTimeIn(<?php echo Session::get('UserId'); ?>)">Mark time In</button>

<h3>Mark Time Out</h3>

<button onclick="handleTimeOut(<?php echo Session::get('UserId'); ?>)">Mark time Out</button>
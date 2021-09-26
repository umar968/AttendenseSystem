<a href="./User/logout">Logout</a>
<a href="./HrDashboard/email">Todays Attendence Report</a>
<h4>HR Dashboard</h4>
<button onclick="addEmployeeBtn()">Add an Employee</button>
<button onclick="listEmployeeBtn()">List Employees</button>
<button onclick="attendenceReportBtn()">Monthly Attendence Report</button>

<form id="employeeForm" enctype="multipart/form-data" method="POST" action="HrDashboard/addEmployee" onload="getBossData()">
    <h3>Add a new Employee</h3>

    <label>Name: </label>
    <input type="text" name="Name" id="Name" required />
    <br>
    <label>User Name</label>
    <input type="text" name="UserName" id="UserName" required />
    <br>
    <label>Profile Picture</label>
    <input type="file" name="ProfilePicture" id="ProfilePicture" />
    <br>
    <label>Salary</label>
    <input type="number" name="Salary" id="Salary" required />
    <br>
    <label>Department</label>
    <select name="Department" id="Department" required>
        <option value="Hr Managment Department">Hr Managment Department</option>
        <option value="Engineering">Engineering</option>
        <option value="Marketing Department">Marketing Department</option>
        <option value="Department 4">Department 4</option>
        <option value="Department 5">Department 5</option>
        <option value="Department 6">Department 6</option>
    </select>
    <br>
    <label>Designation</label>
    <select name="Designation" id="Designation" required>
        <option value="Developer">Developer</option>
        <option value="Manager">Manager</option>
        <option value="Hr Manager">Hr Manager</option>
        <option value="CEO">CEO</option>
    </select>
    <br>
    <label>Boss:</label>
    <select id="Boss" name="Boss">
    </select>
    <br>
    <label>Password</label>
    <input type="password" name="Password" id="Password" required />
    <button type="submit" id="addEmployee">Add new Employee</button>
</form>
<br>
<br>

<table id="listEmployeeTable">
    <caption>List of All Employees</caption>
    <thead>
        <td>
            Name
        </td>
        <td>
            Salary
        </td>
        <td>
            Department
        </td>

        <td>
            Edit
        </td>
        <td>
            Delete
        </td>

    </thead>

</table>
<div id="attendenceReport">
    <h3>Attendece Report</h3>

    <input type="month" name="month" onchange="onDateChange()" max="2021-09">
    <table id="attendenceReport">
        <thead>
            <tr>Name</tr>
            <tr>Date</tr>
            <tr>Status</tr>
        </thead>

    </table>

</div>
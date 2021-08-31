<a href="./User/logout">Logout</a>
<a href="./HrDashboard/email">Click to check those who have not marked in yet</a>
<h4>HR Dashboard</h4>
<form id="employeeform" enctype="multipart/form-data" method="POST" action="HrDashboard/addEmployee" onload="getBossData()">
    <label>Name: </label>
    <input type="text" name="Name" id="Name" />
    <br>
    <label>User Name</label>
    <input type="text" name="UserName" id="UserName" />
    <br>
    <label>Profile Picture</label>
    <input type="file" name="ProfilePicture" id="ProfilePicture" />
    <br>
    <label>Salary</label>
    <input type="number" name="Salary" id="Salary" />
    <br>
    <label>Department</label>
    <select name="Department" id="Department">
        <option value="Hr Managment Department">Hr Managment Department</option>
        <option value="Engineering">Engineering</option>
        <option value="Marketing Department">Marketing Department</option>
        <option value="Department 4">Department 4</option>
        <option value="Department 5">Department 5</option>
        <option value="Department 6">Department 6</option>
    </select>
    <br>
    <label>Designation</label>
    <select name="Designation" id="Designation">
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
    <input type="password" name="Password" id="Password" />
    <button type="submit" id="addEmployee">Add new Employee</button>
</form>
<br>
<br>
<h3>List of All the Employees</h3>
<table class="display">
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
    <tbody id="table">

    </tbody>
</table>
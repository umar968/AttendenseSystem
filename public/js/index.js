const handleTimeIn = (UserId) => {
  // console.log("Handle Time In");
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhr.open(
    "GET",
    `http://localhost/AttendenceSystem/EmployeeDashboard/timeIn/${UserId}`
  );
  xhr.send();
};

const handleTimeOut = (UserId) => {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhr.open(
    "GET",
    `http://localhost/AttendenceSystem/EmployeeDashboard/timeOut/${UserId}`
  );
  xhr.send();
};

getBossData = () => {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const names = JSON.parse(this.response);

      names.forEach((name) => {
        let option = document.createElement("option");
        let value = document.createAttribute("value");
        value.value = name;
        option.innerHTML = name;
        option.setAttributeNode(value);
        document.getElementById("Boss").appendChild(option);
      });
    }
  };
  xhr.open("GET", "http://localhost/AttendenceSystem/HrDashboard/BossList");
  xhr.send();
};
let EmployeeData = null;
window.onload = loadTable = () => {
  getBossData();
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      EmployeeData = JSON.parse(xhr.responseText);
      console.log(EmployeeData);
      const table = document.getElementById("table");
      table.innerHTML = "";
      EmployeeData.forEach((emply, index) => {
        var row = table.insertRow(index);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        cell1.innerHTML = emply[1];
        cell2.innerHTML = emply[2];
        cell3.innerHTML = emply[6];

        var editBtn = document.createElement("Button");
        editBtn.innerHTML = "Edit";
        var onClickAtt = document.createAttribute("onClick");
        onClickAtt.value = "editEmployee(event)";
        var idAtt = document.createAttribute("id");
        idAtt.value = index;
        editBtn.setAttributeNode(idAtt);
        editBtn.setAttributeNode(onClickAtt);
        cell4.appendChild(editBtn);

        var delBtn = document.createElement("Button");
        delBtn.innerHTML = "Delete";
        var onClickAtt = document.createAttribute("onClick");
        onClickAtt.value = "delEmployee(event)";
        var idAtt = document.createAttribute("id");
        idAtt.value = emply[5];
        delBtn.setAttributeNode(idAtt);
        delBtn.setAttributeNode(onClickAtt);
        cell5.appendChild(delBtn);
      });
    }
  };
  xhr.open("GET", "http://localhost/AttendenceSystem/HrDashboard/getEmployees");
  xhr.send();
};
const editEmployee = (event) => {
  const emplyId = event.target.id;
  document.getElementById("Name").value = EmployeeData[emplyId][1];
  document.getElementById("UserName").disabled = true;
  document.getElementById("UserName").value = "User Name cant be changed";
  document.getElementById("Salary").value = EmployeeData[emplyId][2];
  document.getElementById("Department").value = EmployeeData[emplyId][6];
  document.getElementById("Designation").value = EmployeeData[emplyId][6];
  document.getElementById("Boss").value = EmployeeData[emplyId][4];
  document.getElementById("Password").disabled = true;
  document.getElementById("addEmployee").innerHTML = "Edit Employee";
  var form = document.getElementById("employeeform");
  form.setAttribute(
    "action",
    `HrDashboard/editEmployee/${EmployeeData[emplyId][5]}`
  );
};
const delEmployee = (event) => {
  const xhr = new XMLHttpRequest();
  console.log(event.target.id);
  xhr.onreadystatechange = () => {
    if (this.readyState == 4 && this.status == 200) {
      console.log(xhr.responseText);
      loadTable();
    }
  };
  xhr.open(
    "GET",
    `http://localhost/AttendenceSystem/HrDashboard/delEmployee/${event.target.id}`
  );
  xhr.send();
};

const checkStatus = (EmployeeId) => {
  xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("hellp");
      console.log(xhr.response);
    }
    xhr.open(
      "GET",
      `http://localhost/AttendenceSystem/HrDashboard/checkStatus/${EmployeeId}`
    );
    xhr.send();
  };
};

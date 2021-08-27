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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h3>Hello This is login page</h3>
    <p> <?php
        echo Session::get('loginError') !== 'undefined' ? Session::get('loginError') : null;
        ?>
    </p>

    <form method="POST" action="User/login">
        <lable>User Name</lable>
        <input type="text" name="username" />
        <br>
        <label>Password</label>
        <input type="password" name="password" />
        <br>
        <input type="submit" />
    </form>
</body>

</html>
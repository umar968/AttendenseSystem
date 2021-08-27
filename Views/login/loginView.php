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
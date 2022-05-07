<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="logincss.css">
        <style>
</style>
    </head>
    <body>
        <form action="loginPHP.php" method="POST">
        <div class="form-container">
            <div class="user-img"></div>
            <ul class="list">
                <li><h2>Login</h2></li>
                <li><input type="text" name="uname" placeholder="nume"/></li>
                <li><input type="password" name="pass" placeholder="parola"/></li>
                <li><input type="submit" class="loginbtn" name = "Login" value = "Login"></li>
                <li><a href="register.php">Nu aveti cont?</a></li>
            </ul>
        </div>
        </form>
    </body>
</html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="logincss.css">
        <style>
</style>
<script>
</script>
    </head>
    <body>

        <form action="registerPHP.php" method="POST" name="form">
        <div class="form-container">
            <div class="user-img"></div>
            <ul class="list">
                <li><h2>Register</h2></li>
                <li><input type="text" name="uname" placeholder="Nume" required></li>
                <li><input type="password" name="pass" placeholder="Parola" required></li>
                <li><input type="password" name="pass1" placeholder="Reintroduceti parola" required></li>
                <li><input type="email" name="email" placeholder="Email" required></li>
                <li><input type="tel" name="nrTel" placeholder="Numar telefon" required></li>
                <li>
                Sex:
                <ul class = "list">
                    <li><label>Barbat</label><input type="radio" name="gender" value="barbat"></li>
                    <li><label>Femeie</label><input type="radio" name="gender" value="femeie"></li>
                    <li><label>Altceva</label></li><input type="radio" name="gender" value="altceva"></li></ul>
                <li><input type="text" name="tara" placeholder="Tara" required></li>
                <li><button type="submit" class="registerbtn" name = "Register" value = "Register">Register</button></li>
            </ul>
            <p>Deja ai un cont? <a href="http://localhost/GestiuneDepozit/login.php">Log in</a>.</p>
        </div>
        </form>
        
    </body>
</html>
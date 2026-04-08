<?php
session_start();

if($SERVER["REQUEST_METHOD"] == "POST"){
    //
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login</h1> <br>
    <div class="form_login">
        <form action="2-dashboard.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="username"><br>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" placeholder="password">
        </form>
    </div>
</body>

</html>
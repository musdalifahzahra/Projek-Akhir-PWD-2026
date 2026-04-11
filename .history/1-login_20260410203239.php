<?php
session_start();
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //php variabel 
    $username = $_post["username"];
    $password = $_post["password"];

    //cek informasi login
    if ($username === "a" and $password === "a") {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        exit();
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="1-login-css.css">
</head>

<body>
    <div class="login">
        <h1>Login</h1> <br>
        <div class="form_login">
            <form action="2-dashboard.php" method="post">
                <!-- username -->
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" placeholder="username"><br>
                <!-- password -->
                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="password">
                <div class="pesan_error">
                    <?php if ($error === true) { ?>
                        <span>Ussername atau Password salah</span>
                    <?php } ?>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
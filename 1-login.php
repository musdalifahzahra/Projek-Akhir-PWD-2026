<?php
require "0-koneksi.php";
session_start();
$_SESSION["login"] = false;
$users = transaksi_terbaru();

function transaksi_terbaru()
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM users");
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($users  as $user):
        if ($username === $user["username"] and $password === $user["password"]) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["login"] = true;
            header("location: 2-dashboard.php");
            exit();
        }
    endforeach;
    if ($_SESSION["login"] == false) {
        $_SESSION["error"] = "Ussername atau Password salah";
        header("location: 1-login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Laporan Keuangan Toko Sembako Makmur</title>
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="1-login-css.css">
</head>

<body>
    <div class="login">
        <h1>Login</h1> <br>
        <div class="form_login">
            <form action="" method="post">
                <!-- username -->
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" placeholder="username"><br><br>
                <!-- password -->
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="password">
                <div class="pesan_error">
                    <?php if (isset($_SESSION["error"])) { ?>
                        <span><?= $_SESSION["error"] ?></span>
                    <?php unset($_SESSION["error"]);
                    } ?>
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
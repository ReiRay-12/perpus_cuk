<?php
session_start();
require 'config.php';

if(isset($_POST['login'])){
    if(login($_POST)){
        session_regenerate_id(true); // Regenerate session ID for security
        if($_SESSION["role"]=="admin"){
            header("Location: index_admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "<p style='color:red;'>Login gagal! Username atau password salah.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login Sistem Perpustakaan</h1>
    <form method="post" action="">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
    <br>
    <a href="register.php">Belum punya akun? Daftar di sini</a>
</body>
</html>
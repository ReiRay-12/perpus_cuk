<?php
require 'config.php';

if(isset($_POST["register"])){
    if(register($_POST)>0){
        echo "<script>alert('Berhasil daftar');location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Anggota Baru</h1>
    <form method="post">
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
        <div>
            <label for="password2">Konfirmasi Password:</label>
            <input type="password" name="password2" id="password2" required>
        </div>
        <br>
        <button name="register">Daftar</button>
    </form>
    <br>
    <a href="login.php">Sudah punya akun? Login di sini</a>
</body>
</html>
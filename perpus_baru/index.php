<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["role"]!="anggota"){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Dashboard Anggota</h1>
    <p>Halo, <?= $_SESSION["username"]; ?>!</p>
    <nav>
        <ul>
            <li><a href="buku.php">Lihat Buku</a></li>
            <li><a href="peminjaman.php">Pinjam Buku</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
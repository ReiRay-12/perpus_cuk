<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["role"]!="admin"){
    header("Location: login.php");
    exit;
}
?>

<h1>Admin</h1>
<a href="buku.php">Buku</a><br>
<a href="anggota.php">Anggota</a><br>
<a href="peminjaman.php">Peminjaman</a><br>
<a href="logout.php">Logout</a>
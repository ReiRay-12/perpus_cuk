<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["role"]!="user"){
    header("Location: login.php");
    exit;
}
?>

<h1>User</h1>
<a href="buku.php">Buku</a><br>
<a href="peminjaman.php">Pinjam</a><br>
<a href="logout.php">Logout</a>
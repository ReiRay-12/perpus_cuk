<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["role"]!="admin"){
    header("Location: login.php");
    exit;
}

require 'config.php';

$riwayat = query("SELECT p.*, b.judul, a.username FROM peminjaman p JOIN buku b ON p.id_buku = b.id JOIN anggota a ON p.id_anggota = a.id ORDER BY p.tanggal_pinjam DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Halo Admin: <?= $_SESSION["username"]; ?>!</p>
    <nav>
        <ul>
            <li><a href="buku.php">Kelola Buku</a></li>
            <li><a href="anggota.php">Kelola Anggota</a></li>
            <li><a href="peminjaman.php">Kelola Peminjaman</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Riwayat Peminjaman</h2>
    <?php if(empty($riwayat)): ?>
    <p>Belum ada riwayat peminjaman.</p>
    <?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($riwayat as $r): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $r['username']; ?></td>
                <td><?= $r['judul']; ?></td>
                <td><?= $r['tanggal_pinjam']; ?></td>
                <td><?= $r['status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
<?php
session_start();
require 'config.php';

if($_SESSION["role"]!="admin"){
    header("Location: index.php");
    exit;
}

if(isset($_POST["tambah"])) tambahAnggota($_POST);
if(isset($_POST["hapus"])) hapusAnggota($_POST["id"]);

$data = query("SELECT * FROM anggota");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Anggota</h1>
    <nav>
        <ul>
            <li><a href="index_admin.php">Dashboard</a></li>
            <li><a href="buku.php">Kelola Buku</a></li>
            <li><a href="peminjaman.php">Peminjaman</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <br>

    <h2>Tambah Anggota Baru</h2>
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
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="anggota">Anggota</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <br>
        <button name="tambah">Tambah Anggota</button>
    </form>
    <br>

    <h2>Daftar Anggota</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($data as $a): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $a['username']; ?></td>
                <td><?= $a['role']; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $a['id']; ?>">
                        <button name="hapus" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
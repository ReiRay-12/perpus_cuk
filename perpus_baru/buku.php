<?php
session_start();
require 'config.php';

if(isset($_POST["tambah"]) && $_SESSION["role"]=="admin"){
    tambahBuku($_POST);
}
if(isset($_POST["hapus"]) && $_SESSION["role"]=="admin"){
    hapusBuku($_POST["id"]);
}

$data = query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Buku</h1>
    <nav>
        <ul>
            <li><a href="<?php echo $_SESSION["role"]=="admin" ? "index_admin.php" : "index.php"; ?>">Dashboard</a></li>
            <?php if($_SESSION["role"]=="admin"): ?>
            <li><a href="anggota.php">Kelola Anggota</a></li>
            <?php endif; ?>
            <li><a href="peminjaman.php">Peminjaman</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <br>

    <?php if($_SESSION["role"]=="admin"): ?>
    <h2>Tambah Buku Baru</h2>
    <form method="post">
        <div>
            <label for="judul">Judul Buku:</label>
            <input type="text" name="judul" id="judul" required>
        </div>
        <br>
        <div>
            <label for="penulis">Penulis:</label>
            <input type="text" name="penulis" id="penulis" required>
        </div>
        <br>
        <button name="tambah">Tambah Buku</button>
    </form>
    <br>
    <?php endif; ?>

    <h2>Daftar Buku</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <?php if($_SESSION["role"]=="admin"): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($data as $b): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['id']; ?></td>
                <td><?= $b['judul']; ?></td>
                <td><?= $b['penulis']; ?></td>
                <?php if($_SESSION["role"]=="admin"): ?>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $b['id']; ?>">
                        <button name="hapus" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
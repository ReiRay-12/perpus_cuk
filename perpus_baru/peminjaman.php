<?php
session_start();
require 'config.php';

if(!isset($_SESSION["login"])) exit;

$id_user = $_SESSION["id"];

if(isset($_POST["pinjam"])){
    $_POST["id_anggota"] = $id_user;
    $_POST["tanggal_pinjam"] = date('Y-m-d');
    tambahPeminjaman($_POST);
}

if(isset($_POST["hapus"]) && $_SESSION["role"]=="admin"){
    hapusPeminjaman($_POST["id"]);
}

if(isset($_POST["kembalikan"]) && $_SESSION["role"]=="admin"){
    kembalikanPeminjaman($_POST["id"]);
}

if($_SESSION["role"]=="admin"){
    $data = query("SELECT p.*,b.judul,a.username 
    FROM peminjaman p 
    JOIN buku b ON p.id_buku=b.id 
    JOIN anggota a ON p.id_anggota=a.id
    WHERE p.status='dipinjam'");
} else {
    $data = query("SELECT p.*,b.judul 
    FROM peminjaman p 
    JOIN buku b ON p.id_buku=b.id 
    WHERE p.id_anggota=$id_user AND p.status='dipinjam'");
}

$buku = query("SELECT * FROM buku");
$anggota = query("SELECT * FROM anggota WHERE role='anggota'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peminjaman - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Peminjaman Buku</h1>
    <nav>
        <ul>
            <li><a href="<?php echo $_SESSION["role"]=="admin" ? "index_admin.php" : "index.php"; ?>">Dashboard</a></li>
            <li><a href="buku.php">Buku</a></li>
            <?php if($_SESSION["role"]=="admin"): ?>
            <li><a href="anggota.php">Anggota</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <br>

    <h2>Pinjam Buku</h2>
    <form method="post">
        <div>
            <label for="id_buku">Pilih Buku:</label>
            <select name="id_buku" id="id_buku" required>
                <?php foreach($buku as $b): ?>
                <option value="<?= $b['id']; ?>"><?= $b['judul']; ?> - <?= $b['penulis']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <?php if($_SESSION["role"]=="admin"): ?>
        <div>
            <label for="id_anggota">Pilih Anggota:</label>
            <select name="id_anggota" id="id_anggota" required>
                <?php foreach($anggota as $a): ?>
                <option value="<?= $a['id']; ?>"><?= $a['username']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <?php endif; ?>
        <button name="pinjam">Pinjam Buku</button>
    </form>
    <br>

    <h2>Daftar Peminjaman</h2>
    <?php if(empty($data)): ?>
    <p>Tidak ada peminjaman.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <?php if($_SESSION["role"]=="admin"): ?>
                <th>Anggota</th>
                <?php endif; ?>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <?php if($_SESSION["role"]=="admin"): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($data as $p): ?>
            <tr>
                <td><?= $i++; ?></td>
                <?php if($_SESSION["role"]=="admin"): ?>
                <td><?= $p['username']; ?></td>
                <?php endif; ?>
                <td><?= $p['judul']; ?></td>
                <td><?= $p['tanggal_pinjam']; ?></td>
                <?php if($_SESSION["role"]=="admin"): ?>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $p['id']; ?>">
                        <button name="kembalikan" onclick="return confirm('Yakin kembalikan buku?')">Kembalikan</button>
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
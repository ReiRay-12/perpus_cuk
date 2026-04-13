<?php
session_start();
require 'config.php';

if(!isset($_SESSION["login"])) exit;

// ambil anggota user
$u = query("SELECT * FROM anggota WHERE nama='$_SESSION[user]'");
$id_user = isset($u[0]['id']) ? $u[0]['id'] : 0;

if(isset($_POST["pinjam"])){
    if($_SESSION["role"]=="user"){
        $_POST["id_anggota"] = $id_user;
    }
    tambahPeminjaman($_POST);
}

if(isset($_POST["hapus"]) && $_SESSION["role"]=="admin"){
    hapusPeminjaman($_POST["id"]);
}

if($_SESSION["role"]=="admin"){
    $data = query("SELECT p.*,b.judul,a.nama FROM peminjaman p JOIN buku b ON p.id_buku=b.id JOIN anggota a ON p.id_anggota=a.id");
} else {
    $data = query("SELECT p.*,b.judul FROM peminjaman p JOIN buku b ON p.id_buku=b.id WHERE p.id_anggota=$id_user");
}

$buku = query("SELECT * FROM buku");
$anggota = query("SELECT * FROM anggota");
?>

<h2>Peminjaman</h2>

<form method="post">
<select name="id_buku">
<?php foreach($buku as $b): ?>
<option value="<?= $b['id']; ?>"><?= $b['judul']; ?></option>
<?php endforeach; ?>
</select>

<?php if($_SESSION["role"]=="admin"): ?>
<select name="id_anggota">
<?php foreach($anggota as $a): ?>
<option value="<?= $a['id']; ?>"><?= $a['nama']; ?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>

<input type="date" name="tanggal_pinjam">
<button name="pinjam">Pinjam</button>
</form>

<hr>

<?php foreach($data as $p): ?>
<p>
<?= $_SESSION["role"]=="admin" ? $p['nama']." - " : "" ?>
<?= $p['judul']; ?>

<?php if($_SESSION["role"]=="admin"): ?>
<form method="post" style="display:inline;">
<input type="hidden" name="id" value="<?= $p['id']; ?>">
<button name="hapus">Hapus</button>
</form>
<?php endif; ?>

</p>
<?php endforeach; ?>
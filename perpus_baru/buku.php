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

<h2>Buku</h2>

<?php if($_SESSION["role"]=="admin"): ?>
<form method="post">
<input name="judul">
<input name="penulis">
<button name="tambah">Tambah</button>
</form>
<?php endif; ?>

<?php foreach($data as $b): ?>
<p>
<?= $b['judul']; ?>
<?php if($_SESSION["role"]=="admin"): ?>
<form method="post" style="display:inline;">
<input type="hidden" name="id" value="<?= $b['id']; ?>">
<button name="hapus">Hapus</button>
</form>
<?php endif; ?>
</p>
<?php endforeach; ?>
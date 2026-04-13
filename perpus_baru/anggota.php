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

<h2>Anggota</h2>

<form method="post">
<input name="nama">
<input name="kelas">
<button name="tambah">Tambah</button>
</form>

<?php foreach($data as $a): ?>
<p>
<?= $a['nama']; ?>
<form method="post" style="display:inline;">
<input type="hidden" name="id" value="<?= $a['id']; ?>">
<button name="hapus">Hapus</button>
</form>
</p>
<?php endforeach; ?>
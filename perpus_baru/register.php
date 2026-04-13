<?php
require 'config.php';

if(isset($_POST["register"])){
    if(register($_POST)>0){
        echo "<script>alert('Berhasil daftar');location='login.php';</script>";
    }
}
?>

<h2>Register</h2>
<form method="post">
<input name="username"><br>
<input type="password" name="password"><br>
<input type="password" name="password2"><br>
<button name="register">Daftar</button>
</form>
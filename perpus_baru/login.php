<?php
session_start();
require 'config.php';

if(isset($_POST['login'])){
    if(login($_POST)){
        if($_SESSION["role"]=="admin"){
            header("Location: index_admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Login gagal!";
    }
}
?>

 <form method="post" action="">
         <div>
             <label for="username">Username</label>
             <Input type="text" name="username" id="username">
         </div>

         <div>
             <label for="password">Password</label>
             <Input type="password" name="password" id="password">
         </div>

        <button type="submit" name="login">Login</button>
    </form>

<a href="register.php">Daftar</a>
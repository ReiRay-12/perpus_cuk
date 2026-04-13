<?php
$conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($q){
    global $conn;
    $res = mysqli_query($conn,$q);
    $rows=[];
    while($r=mysqli_fetch_assoc($res)){
        $rows[]=$r;
    }
    return $rows;
}

// LOGIN
function login($data){
    global $conn;

    $username = $data["username"];
    $password = $data["password"];

    $res = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($res)===1){
        $row = mysqli_fetch_assoc($res);

        if(password_verify($password,$row["password"])){
            $_SESSION["login"]=true;
            $_SESSION["role"]=$row["role"];
            $_SESSION["user"]=$row["username"];
            return true;
        }
    }
    return false;
}

// REGISTER
function register($data){
    global $conn;

    $u = strtolower($data["username"]);
    $p = $data["password"];
    $p2 = $data["password2"];

    if($p!=$p2){
        echo "Password tidak sama!";
        return false;
    }

    $cek = mysqli_query($conn,"SELECT * FROM user WHERE username='$u'");
    if(mysqli_fetch_assoc($cek)){
        echo "Username sudah ada!";
        return false;
    }

    $hash = password_hash($p,PASSWORD_DEFAULT);

    mysqli_query($conn,"INSERT INTO user VALUES('','$u','$hash','user')");

    // otomatis jadi anggota
    mysqli_query($conn,"INSERT INTO anggota VALUES('','$u','-')");

    return mysqli_affected_rows($conn);
}

// BUKU
function tambahBuku($d){
    global $conn;
    mysqli_query($conn,"INSERT INTO buku VALUES('','$d[judul]','$d[penulis]')");
}
function hapusBuku($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM buku WHERE id=$id");
}

// ANGGOTA
function tambahAnggota($d){
    global $conn;
    mysqli_query($conn,"INSERT INTO anggota VALUES('','$d[nama]','$d[kelas]')");
}
function hapusAnggota($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM anggota WHERE id=$id");
}

// PEMINJAMAN
function tambahPeminjaman($d){
    global $conn;
    mysqli_query($conn,"INSERT INTO peminjaman VALUES('','$d[id_buku]','$d[id_anggota]','$d[tanggal_pinjam]')");
}
function hapusPeminjaman($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM peminjaman WHERE id=$id");
}
?>
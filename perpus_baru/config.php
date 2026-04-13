<?php
$conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

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

    $u = $data["username"];
    $p = $data["password"];

    $res = mysqli_query($conn,"SELECT * FROM anggota WHERE username='$u'");

    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);

        if(password_verify($p,$row["password"])){
            $_SESSION["login"]=true;
            $_SESSION["id"]=$row["id"];
            $_SESSION["username"]=$row["username"];
            $_SESSION["role"]=$row["role"];
            return true;
        }
    }
    return false;
}

// REGISTER
function register($d){
    global $conn;

    $u = strtolower($d["username"]);
    $p = $d["password"];
    $p2 = $d["password2"];

    if($p != $p2){
        echo "Password tidak sama!";
        return false;
    }

    $cek = mysqli_query($conn,"SELECT * FROM anggota WHERE username='$u'");
    if(mysqli_fetch_assoc($cek)){
        echo "Username sudah ada!";
        return false;
    }

    $hash = password_hash($p,PASSWORD_DEFAULT);

    mysqli_query($conn,"INSERT INTO anggota VALUES('','$u','$hash','anggota')");

    return mysqli_affected_rows($conn);
}

// ANGGOTA
function tambahAnggota($d){
    global $conn;
    $u = strtolower($d["username"]);
    $p = password_hash($d["password"], PASSWORD_DEFAULT);
    $r = $d["role"];
    mysqli_query($conn,"INSERT INTO anggota VALUES('','$u','$p','$r')");
    return mysqli_affected_rows($conn);
}
function hapusAnggota($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM anggota WHERE id=$id");
}

// BUKU
function tambahBuku($d){
    global $conn;
    mysqli_query($conn,"INSERT INTO buku VALUES('','$d[judul]','$d[penulis]')");
    return mysqli_affected_rows($conn);
}
function hapusBuku($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM buku WHERE id=$id");
}

// PEMINJAMAN
function tambahPeminjaman($d){
    global $conn;
    if(!isset($d['id_buku']) || !isset($d['id_anggota'])){
        echo "Data peminjaman tidak lengkap!";
        return false;
    }
    mysqli_query($conn,"INSERT INTO peminjaman VALUES('','$d[id_buku]','$d[id_anggota]','$d[tanggal_pinjam]','dipinjam')");
    return mysqli_affected_rows($conn);
}
function hapusPeminjaman($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM peminjaman WHERE id=$id");
}
function kembalikanPeminjaman($id){
    global $conn;
    mysqli_query($conn,"UPDATE peminjaman SET status='dikembalikan' WHERE id=$id");
}
?>
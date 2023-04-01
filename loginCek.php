<?php 
session_start();
include_once "koneksi.php";
    $username = $_POST['txtUser'];
    $pass = $_POST['txtPass'];
    $sql = "SELECT * FROM akun
                where username = '$username'
                and pass = '$pass'";
    $query = mysqli_query($koneksi, $sql);

    $found = mysqli_num_rows($query);
    $fetch = mysqli_fetch_array($query);
    if($found > 0){
        session_start();
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['pass'] = $fetch['pass'];
        header("location:pakar/index.php");
    }else{
        echo'<div class="container"><div class=" alert alert-danger role=alert">
        <b>USERNAME DAN PASSWORD TIDAK SESUAI</b>
        </div></div>';
    include 'index.php';
    exit;
    }
?>
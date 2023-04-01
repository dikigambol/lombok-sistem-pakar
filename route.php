<?php
    $page = isset($_GET['page']) ? $_GET['page']: '';
    if($page == "daftarPenyakit"){
        if(file_exists("daftarPenyakit.php")){
            include "daftarPenyakit.php";
        }
        else{
            echo"File penyakit tidak ditemukan!";
        }
    }
    elseif($page == "daftarGejala"){
        if(file_exists("daftarGejala.php")){
            include "daftarGejala.php";
        }
        else{
            echo"file gejala tidak ditemukan!";
        }
    }
    elseif($page == "datatoko"){
        if(file_exists("datatoko.php")){
            include "datatoko.php";
        }
        else{
            echo"file toko tidak ditemukan!";
        }
    }
    elseif($page == "daftar"){
        if(file_exists("petaniAddFm.php")){
            include "petaniAddFm.php";
        }
        else{
            echo"file data petani tidak ditemukan!";
        }
    }
    elseif($page == "daftarSimpan"){
        if(file_exists("petaniAddSimpan.php")){
            include "petaniAddSimpan.php";
        }
        else{
            echo"file simpan data petani tidak ditemukan!";
        }
    }
    elseif($page == "konsultasi"){
        if(file_exists("konsultasi.php")){
            include "konsultasi.php";
        }
        else{
            echo"file konsultasi tidak ditemukan!";
        }
    }
    elseif($page == "konsultasiCek"){
        if(file_exists("konsultasiCek.php")){
            include "konsultasiCek.php";
        }
        else{
            echo"file cek konsul tidak ditemukan!";
        }
    }
    elseif($page == "konsultasilanjut"){
        if(file_exists("konsultasilanjut.php")){
            include "konsultasilanjut.php";
        }
        else{
            echo"file cfKonsul tidak ditemukan!";
        }
    }
    elseif($page == "konsultasilanjutcek"){
        if(file_exists("konsultasilanjutcek.php")){
            include "konsultasilanjutcek.php";
        }
        else{
            echo"file cfcek tidak ditemukan!";
        }
    }
    elseif($page == "hasil"){
        if(file_exists("hasil.php")){
            include "hasil.php";
        }
        else{
            echo"file analisa hasil tidak ditemukan!";
        }
    }
    elseif($page == "home"){
        if(file_exists("home.php")){
            include "home.php";
        }
        else{
            echo"file home tidak ditemukan!";
        }
    }
    elseif($page == "daftartoko"){
        if(file_exists("daftartoko.php")){
            include "daftartoko.php";
        }
        else{
            echo"file daftartoko tidak ditemukan!";
        }
    }
    elseif($page == "daftartokoFungsi"){
        if(file_exists("daftartokoFungsi.php")){
            include "daftartokoFungsi.php";
        }
        else{
            echo"file daftartokoFungsi tidak ditemukan!";
        }
    }else{
        include "home.php";
    }
?>
<?php
    include "../koneksi.php";

    //get variable dari form
    $txtKode= $_POST['txtKode'];
    $txtGejala= $_POST['txtGejala'];

    //validasi
    if(trim($txtKode)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode masih kosong, Ulangi Kembali</b>
                </div>
             </div>';
             include "gejalaTambah.php";
    }
    elseif(trim($txtGejala)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama gejala masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "gejalaTambah.php";
    }
    else{
        //insert ke table
        $sql = "INSERT into gejala (id_gejala, nama_gejala) 
                    VALUES ('$txtKode', '$txtGejala')";
        mysqli_query($koneksi, $sql);

        echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DISIMPAN</b>
                </div>
             </div>';
             include "gejalaTampil.php"; 
    }
?>
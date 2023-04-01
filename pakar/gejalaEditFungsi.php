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
             include "gejalaEdit.php";
    }
    elseif(trim($txtGejala)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama gejala masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "gejalaEdit.php";
    }
    else{
        //update ke table
        $sql = "UPDATE gejala set
                            id_gejala = '$txtKode',
                            nama_gejala = '$txtGejala'
                            where id_gejala = '$txtKode'";
        mysqli_query($koneksi, $sql) or die("sql in error".mysqli_error($koneksi));

        echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DIEDIT</b>
                </div>
             </div>';
             include "gejalaTampil.php"; 
    }
?>
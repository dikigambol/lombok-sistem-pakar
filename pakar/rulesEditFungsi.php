<?php
    include "../koneksi.php";

    //get variable dari form
    $txtKode= $_POST['txtKode'];
    $txtKodeG= $_POST['txtKodeG'];
    $txtKodeP= $_POST['txtKodeP'];
    $txtGejala= $_POST['txtGejala'];
    $txtPenyakit= $_POST['txtPenyakit'];
    $txtYakin= $_POST['txtYakin'];
    $txtTakYakin= $_POST['txtTakYakin'];
    $cf = $txtYakin - $txtTakYakin;
    //validasi
    if(trim($txtKode)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode masih kosong, Ulangi Kembali</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtKodeG)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode gejala masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtKodeP)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode Penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtGejala)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama gejala masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtPenyakit)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama Penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtYakin)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Keyakinan masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    elseif(trim($txtTakYakin)==""){
        echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Ketidakyakinan masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
             include "rulesEdit.php";
    }
    else{
        //update ke table
        $sql = "UPDATE rules_penyakit set
                            id_rules = '$txtKode',
                            id_penyakit = '$txtKodeP',
                            id_gejala = '$txtKodeG',
                            keyakinan = '$txtYakin',
                            ketidakyakinan = '$txtTakYakin',
                            CF = '$cf'
                            where id_rules = '$txtKode'";
        mysqli_query($koneksi, $sql) or die("sql in error".mysqli_error($koneksi));

        echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DIEDIT</b>
                </div>
             </div>';
             include "rulesTampil.php"; 
    }
?>
<?php
include "../koneksi.php";

//get variable dari form
$txtKode = $_POST['txtKode'];
$txtPenyakit = $_POST['txtPenyakit'];
$txtInfoPenyakit = $_POST['txtInfoPenyakit'];
$txtPenanganan = $_POST['txtPenanganan'];

//validasi
if (trim($txtKode) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode masih kosong, Ulangi Kembali</b>
                </div>
             </div>';
    include "penyakitTambah.php";
} elseif (trim($txtPenyakit) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "penyakitTambah.php";
} elseif (trim($txtInfoPenyakit) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Info penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "penyakitTambah.php";
} else {
    //insert gambar ke dir

    $tempdir = "../image/";
    if (!file_exists($tempdir))
        mkdir($tempdir, 0755);
    $target_path1 = $tempdir . basename($_FILES['txtGambar']['name']);
    $target_path2 = $tempdir . basename($_FILES['txtObat']['name']);

    //nama gambar
    $nama_gambar = $_FILES['txtGambar']['name'];
    $nama_gambar2 = $_FILES['txtObat']['name'];

    move_uploaded_file($_FILES['txtGambar']['tmp_name'], $target_path1);
    move_uploaded_file($_FILES['txtObat']['tmp_name'], $target_path2);

    //insert ke table
    $sql = "INSERT into penyakit (id_penyakit, nama_penyakit, info_penyakit, penanganan, gambar, obat)";
    $sql .= "VALUES ('$txtKode', '$txtPenyakit', '$txtInfoPenyakit', '$txtPenanganan','$nama_gambar', '$nama_gambar2')";
    mysqli_query($koneksi, $sql);

    echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DISIMPAN</b>
                </div>
             </div>';
    include "penyakitTampil.php";
}

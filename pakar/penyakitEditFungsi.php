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
    include "penyakitEdit.php";
} elseif (trim($txtPenyakit) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "penyakitEdit.php";
} elseif (trim($txtInfoPenyakit) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Info penyakit masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "penyakitEdit.php";
} else {
    //update gambar ke dir
    $getfile = "SELECT gambar, obat FROM penyakit WHERE id_penyakit = '$txtKode'";
    $query = mysqli_query($koneksi, $getfile);
    $result = mysqli_fetch_array($query);
    $dir = "../image/";
    $gambarpenyakit = $result['gambar'];
    $gambarobat = $result['obat'];

    $nama_gambar = $_FILES['txtGambar']['name'];
    $nama_gambar2 = $_FILES['txtObat']['name'];

    if ($nama_gambar != '') {
        unlink($dir . $gambarpenyakit);
        move_uploaded_file($_FILES['txtGambar']['tmp_name'], $dir . basename($_FILES['txtGambar']['name']));
    } else {
        $nama_gambar = $gambarpenyakit;
    }

    if ($nama_gambar2 != '') {
        unlink($dir . $gambarobat);
        move_uploaded_file($_FILES['txtObat']['tmp_name'], $dir . basename($_FILES['txtObat']['name']));
    } else {
        $nama_gambar2 = $gambarobat;
    }

    //update ke table
    $sql = "UPDATE penyakit set
                            id_penyakit = '$txtKode',
                            nama_penyakit = '$txtPenyakit',
                            info_penyakit = '$txtInfoPenyakit',
                            penanganan = '$txtPenanganan',
                            gambar = '$nama_gambar',
                            obat = '$nama_gambar2'
                            where id_penyakit = '$txtKode'";
    mysqli_query($koneksi, $sql) or die("sql in error" . mysqli_error($koneksi));

    echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DIEDIT</b>
                </div>
             </div>';
    include "penyakitTampil.php";
}

<?php
include "../koneksi.php";

//get variable dari form
$txtKode = $_POST['txtKode'];
$txtToko = $_POST['txtToko'];
$txtAlamatToko = $_POST['txtAlamatToko'];
$txtNomorTelepon = $_POST['txtNomorTelepon'];
$txtMapToko = $_POST['txtMapToko'];

//validasi
if (trim($txtKode) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Kode masih kosong, Ulangi Kembali</b>
                </div>
             </div>';
    include "tokoEdit.php";
} elseif (trim($txtToko) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama toko masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "tokoEdit.php";
} elseif (trim($txtAlamatToko) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Alamat toko masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "tokoEdit.php";
} elseif (trim($txtNomorTelepon) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nomor Telepon masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "tokoEdit.php";
} elseif (trim($txtMapToko) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Link map toko masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "tokoEdit.php";
} else {
    //update gambar ke dir
    $getfile = "SELECT gambar_toko FROM toko WHERE id_toko = '$txtKode'";
    $query = mysqli_query($koneksi, $getfile);
    $result = mysqli_fetch_array($query);
    $dir = "../image/";
    $gambartoko = $result['gambar_toko'];

    $nama_gambar = $_FILES['txtGambarToko']['name'];

    if ($nama_gambar != '') {
        unlink($dir . $gambartoko);
        move_uploaded_file($_FILES['txtGambarToko']['tmp_name'], $dir . basename($_FILES['txtGambarToko']['name']));
    } else {
        $nama_gambar = $gambartoko;
    }

    //update ke table
    $sql = "UPDATE toko set
                            id_toko = '$txtKode',
                            nama_toko = '$txtToko',
                            alamat_toko = '$txtAlamatToko',
                            nomor_telepon = '$txtNomorTelepon',
                            gambar_toko = '$nama_gambar',
                            map_toko = '$txtMapToko'
                            where id_toko = '$txtKode'";
    mysqli_query($koneksi, $sql) or die("sql in error" . mysqli_error($koneksi));

    echo '<div class="container">
                <div class="alert alert-success role=alert">
                    <b>DATA BERHASIL DIEDIT</b>
                </div>
             </div>';
    include "tokoTampil.php";
}

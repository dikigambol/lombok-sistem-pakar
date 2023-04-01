<?php
include "koneksi.php";

//get variable dari form
$txtToko = $_POST['txtToko'];
$txtAlamatToko = $_POST['txtAlamatToko'];
$txtNomorTelepon = $_POST['txtNomorTelepon'];
$txtMapToko = $_POST['txtMapToko'];

//validasi
if (trim($txtToko) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nama toko masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "daftartoko.php";
} elseif (trim($txtAlamatToko) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Alamat Toko masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "daftartoko.php";
} elseif (trim($txtNomorTelepon) == "") {
    echo '<div class="container">
                <div class="alert alert-danger role=alert">
                    <b>Nomor telepon masih kosong, isi terlebih dahulu</b>
                </div>
             </div>';
    include "daftartoko.php";
} else {
    $getlastId = "SELECT id_toko FROM toko ORDER BY id_toko DESC LIMIT 1";
    $queryId = mysqli_query($koneksi, $getlastId);
    $resultId = mysqli_fetch_array($queryId);

    $resId = $resultId['id_toko'] ?? "empty";

    $newId = '';

    if ($resId == "empty") {
        $newId = 'T01';
    } else {
        $lastId = trim($resId, "T") + 1;
        if ($lastId < 10) {
            $newId = "T0" . $lastId;
        } else {
            $newId = "T" . $lastId;
        }
    }

    //insert gambar ke dir
    $tempdir = "image/";
    if (!file_exists($tempdir))
        mkdir($tempdir, 0755);

    $temp = explode(".", $_FILES["txtGambarToko"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_path1 = $tempdir . $newfilename;

    move_uploaded_file($_FILES['txtGambarToko']['tmp_name'], $target_path1);

    //insert ke table
    $sql = "INSERT into toko (id_toko, nama_toko, alamat_toko, nomor_telepon, gambar_toko, map_toko)";
    $sql .= "VALUES ('$newId', '$txtToko', '$txtAlamatToko', '$txtNomorTelepon', '$newfilename', '$txtMapToko')";
    mysqli_query($koneksi, $sql);
    
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=datatoko'>";
}

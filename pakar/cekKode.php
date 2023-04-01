<?php
function cekKode($tabel, $inisial){
    include "../koneksi.php";
    $sql = "SELECT * from $tabel";
    $query = mysqli_query($koneksi, $sql);
    $field    = mysqli_field_name($query, 0);
    $panjang  = mysqli_field_len($query, 0);

    $query = mysqli_query("SELECT max(".$field.") form ".$tabel);
    $row = mysqli_fetch_array($query);
    if($row[0]==""){
        $angka=1;
    }
    else{
        $angka = substr($row[0], strlen($inisial));
    }

    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for($i = 1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++){
        $tmp=$tmp."0";
    }
    return $inisial.$tmp.$angka;
}
?>
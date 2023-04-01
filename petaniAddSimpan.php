<?php 
include "koneksi.php";

# Baca variabel Form (If Register Global ON)
$txtNama = $_POST['txtNama'];
$txtAlamat = $_POST['txtAlamat'];

//validasi form isian
if(trim($txtNama)==""){
    include "petaniAddFm.php";
    echo '<div class="col-md-4 col-md-offset-8 alert alert-danger role=alert">
	Nama belum diisi, ulangi kembali
	</div></br>';
}elseif(trim($txtAlamat)==""){
    include "petaniAddFm.php";
    echo '<div class="col-md-4 col-md-offset-8 alert alert-danger role=alert">
    Alamat belum diisi, harap isi alamat!
    </div><br>';
}
else{
    $noID = $_SERVER['REMOTE_ADDR'];
    $sqldel = "DELETE from tmp_petani where noID='$noID";
    mysqli_query($koneksi, $sqldel);

    $sqlin = "INSERT into tmp_petani(nama_petani, alamat, noID, ctr)
                Values ('$txtNama', '$txtAlamat', '$noID', '1')";
    mysqli_query($koneksi, $sqlin) or die("sql in error".mysqli_error($koneksi));

    $sqlhapus = "DELETE from tmp_penyakit where noID='$noID'";
    mysqli_query($koneksi, $sqlhapus);
    
    $sqlhapus2 = "DELETE from tmp_analisa where noID='$noID'";
    mysqli_query($koneksi, $sqlhapus2);

    $sqlhapus3 = "DELETE from tmp_gejala where noID='$noID'";
    mysqli_query($koneksi, $sqlhapus3);

    $sqlhapus4 = "DELETE from tmp_cf where noID='$noID'";
    mysqli_query($koneksi, $sqlhapus4);

    echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasi'>";
}
?>
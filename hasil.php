<?php
include "koneksi.php";

$noID = $_SERVER['REMOTE_ADDR'];

$cekPenyakitSql = "SELECT * FROM konsultasi where noID='$noID' order by id_konsultasi desc limit 1";
$queryCek = mysqli_query($koneksi, $cekPenyakitSql);
$cekPenyakit = mysqli_fetch_array($queryCek);

$idPenyakit = "";
if ($cekPenyakit['id_penyakit'] == "") {
    $idPenyakit = "kosong";
} else {
    $idPenyakit = $cekPenyakit['id_penyakit'];
}

if ($idPenyakit != 'kosong') {
    $sql = "SELECT konsultasi.*, penyakit.*
        from konsultasi, penyakit
        where penyakit.id_penyakit = konsultasi.id_penyakit
        and konsultasi.noID='$noID'
        order by konsultasi.id_konsultasi desc limit 1";
    $query = mysqli_query($koneksi, $sql);
    if (!$query) {
        printf("Error: %s\n", mysqli_error($koneksi));
        exit();
    }
    $result = mysqli_fetch_array($query);
}
?>

<html>

<head>
    <title>Hasil Diagnosa</title>
</head>

<body>
    <div class="container">
        <center>
            <h4> Hasil Diagnosa Penyakit Tanaman Cabai Rawit</h4>
        </center>
    </div>
    <?php if ($idPenyakit == 'kosong') { ?>
        <div class="container" style="padding: 12.3% 0;">
            <div class="col-md-12">
                <p align="center">Penyakit tidak ditemukan.</p>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <center>
                            <h5><b>Hasil Analisa </b></h5>
                        </center>
                        <p>Nama Petani : <?php echo $result['nama_petani']; ?></p>
                        <p>Alamat : <?php echo $result['alamat']; ?></p>
                        <p>Penyakit : <b class="red-text"><?php echo $result['nama_penyakit']; ?></b></p>
                    </div>
                    <div>
                        <p>Gejala :</p>
                        <ul>
                            <li>
                                <?php
                                $sql_gejala = "SELECT gejala.* from gejala, rules_penyakit
                                                    where gejala.id_gejala = rules_penyakit.id_gejala
                                                    and rules_penyakit.id_penyakit = '$result[id_penyakit]'";
                                $query_gejala = mysqli_query($koneksi, $sql_gejala);
                                $i = 0;
                                while ($result_gejala = mysqli_fetch_array($query_gejala)) {
                                    $i++;
                                    echo "$i. $result_gejala[nama_gejala] <br>";
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <h5><b>Gambar Penyakit </b></h5>
                        <img src="image/<?php echo $result['gambar']; ?>" style="height:250px; margin:15px 0px">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><b>Keterangan</b></h5>
                    <p class="text-justify"> <?php echo $result['info_penyakit']; ?> </p>
                </div>
                <div class="col-md-6">
                    <div>
                        <h5><b>Obat Penyakit</b></h5>
                        <img src="image/<?php echo $result['obat']; ?>" style="height:250px; margin:15px 0px">
                    </div>
                </div>
            </div>
        </div>
        <div class="row center">
            <a href="index.php?page=datatoko" id="" class="btn-lg waves-effect waves-light green noatt white-text">Daftar Toko Obat</a>
            <a href="index.php?page=home" id="diagnosa" class="btn-lg waves-effect waves-light red noatt white-text">Selesai</a>
        </div>
    <?php } ?>
</body>

</html>
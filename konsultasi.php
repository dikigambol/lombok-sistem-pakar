<?php
include "koneksi.php";

$noID = $_SERVER['REMOTE_ADDR'];

# periksa apabila sudah ditemukan
//periksa data penyakit di dalam tmp
$sql_cekh = "SELECT * FROM tmp_penyakit 
                        WHERE noID='$noID'
                        Group by id_penyakit";
$query_cekh = mysqli_query($koneksi, $sql_cekh);
$result_cekh = mysqli_num_rows($query_cekh);
if ($result_cekh == 1) {
    //redireksi setelah pemindahan data
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasilanjut'>";
    exit;
}

#apabila belum menemukan penyakit
$sqlcek = "SELECT * from tmp_analisa where noID='$noID'";
$querycek = mysqli_query($koneksi, $sqlcek);
$resultcek = mysqli_num_rows($querycek);
if ($resultcek >= 1) {
    //seandainya tmp_analisa tidak kosong
    //SQL ambil data gejala yang tidak ada di dalam tabel tmp_gejala (NOT IN...)
    $sqlg = "SELECT gejala.* from gejala, tmp_analisa
                    where gejala.id_gejala = tmp_analisa.id_gejala
                    and tmp_analisa.noID = '$noID'
                    and not tmp_analisa.id_gejala
                        in(select id_gejala 
                        from tmp_gejala where noID='$noID')
                    order by gejala.id_gejala asc";
    $queryg = mysqli_query($koneksi, $sqlg);
    $resultg = mysqli_fetch_array($queryg);

    $id_gejala = $resultg['id_gejala'];
    $gejala = $resultg['nama_gejala'];
} else {
    // Seandainya tmp kosong
    // ambil data gejala dari tabel gejala
    $sqlg = "SELECT gejala.* from rules_penyakit, gejala
                where gejala.id_gejala = rules_penyakit.id_gejala";
    $queryg = mysqli_query($koneksi, $sqlg);
    $resultg = mysqli_fetch_array($queryg);
    $id_gejala = $resultg['id_gejala'];
    $gejala = $resultg['nama_gejala'];
}
?>

<html>

<head>
    <title>Form Diagnosa</title>
</head>

<body>
    <div class="container">
        <form action="?page=konsultasiCek" method="post" name="form1" target="_self">
            <div>
                <br><br><br>
                <h5>Jawablah Pertanyaan Berikut!<h5>
            </div>
            <div>
                <p width="312">Apakah <b><?php echo "$gejala"; ?></b> ?
                    <input name="txtIdGejala" type="hidden" value="<?php echo $id_gejala; ?>">
                </p>
            </div>
            <div class="radio">
                <label><input type="radio" name="rbPilih" value="ya" class="with-gap"><span class="black-text">Ya</span></label>
            </div>
            <div class="radio">
                <label><input type="radio" name="rbPilih" value="tidak" class="with-gap"><span class="black-text">Tidak</span></label>
            </div>
            <div>
                <input type="submit" class="btn-success" name="Submit" value="Jawab">
            </div>
            <br>
            <!-------------------------------------------------------------------------------------->
            <div>
                <br><br>
                <strong>Penyakit yang mungkin menyerang</strong><br>
            </div>

            <div>
                <p>
                    <?php
                    //sql penyakit
                    $sqlp = "SELECT penyakit.* from penyakit, tmp_penyakit
                                where penyakit.id_penyakit = tmp_penyakit.id_penyakit
                                and tmp_penyakit.noID='$noID'
                                group by tmp_penyakit.id_penyakit";
                    $queryp = mysqli_query($koneksi, $sqlp);
                    $resultp = mysqli_num_rows($queryp);
                    if ($resultp == 0) {
                        echo " - belum ada";
                    }
                    while ($resultp = mysqli_fetch_array($queryp)) {
                        echo " - $resultp[nama_penyakit] <br>";
                    }
                    ?>
                </p>
            </div><br><br><br><br>
        </form>
    </div>
</body>

</html>
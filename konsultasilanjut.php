<?php
include "koneksi.php";

$noID = $_SERVER['REMOTE_ADDR'];

$sqlcek = "SELECT id_gejala from tmp_analisa
                WHERE id_gejala NOT IN (SELECT id_gejala from tmp_cf)
                and noID = '$noID'";
$querycek = mysqli_query($koneksi, $sqlcek);
$resultcek = mysqli_num_rows($querycek);

if ($resultcek >= 1) {
    //sql pertanyaan gejala (untuk pertanyaan selajutnya)
    $sqlg = "SELECT gejala.* from gejala, tmp_analisa, tmp_cf
                    where gejala.id_gejala = tmp_analisa.id_gejala
                    and tmp_analisa.noID = '$noID'
                    and not tmp_analisa.id_gejala
                        in(select id_gejala 
                        from tmp_cf where noID='$noID')
                    order by gejala.id_gejala asc";
    $queryg = mysqli_query($koneksi, $sqlg);
    $resultg = mysqli_fetch_array($queryg);
    $id_gejala = $resultg['id_gejala'];
    $gejala = $resultg['nama_gejala'];
} else {
    //cek solusi pada tmp
    //sql h
    $sql_cekh = "SELECT * FROM tmp_penyakit WHERE noID='$noID'";
    $query_cekh = mysqli_query($koneksi, $sql_cekh);
    $result_cekh = mysqli_num_rows($query_cekh);

    if ($result_cekh == 1) {
        //apabila data tmp_penyakit isinya 1
        $result_cekh = mysqli_fetch_array($query_cekh);
        //sql petani
        $sql_petani = "SELECT * FROM tmp_petani Where noID='$noID'
                    order by id_petani desc";
        $query_petani = mysqli_query($koneksi, $sql_petani);
        $result_petani = mysqli_fetch_array($query_petani);
        // perintah untuk memindah data   
        $sql_in = "INSERT into konsultasi set
                nama_petani = '$result_petani[nama_petani]',
                alamat = '$result_petani[alamat]',
                id_penyakit = '$result_cekh[id_penyakit]',
                noID = '$result_petani[noID]'";
        mysqli_query($koneksi, $sql_in);

        $sql_analisa = "DELETE from tmp_analisa where noID='$noID'";
        mysqli_query($koneksi, $sql_analisa);

        $sql_delcf = "DELETE from tmp_cf where noID='$noID'";
        mysqli_query($koneksi, $sql_delcf);

        $sql_gejala = "DELETE from tmp_gejala where noID='$noID'";
        mysqli_query($koneksi, $sql_gejala);

        $sql_penyakit = "DELETE from tmp_penyakit where noID='$noID'";
        mysqli_query($koneksi, $sql_penyakit);

        $sql_petani = "DELETE from tmp_petani where noID='$noID'";
        mysqli_query($koneksi, $sql_petani);

        //redirect setelah insert data
        echo "<meta http-equiv='refresh' content='0; url=index.php?page=hasil'>";
        exit;
    } else {
        //sql petani
        $sql_petani = "SELECT * FROM tmp_petani Where noID='$noID'
                    order by id_petani desc";
        $query_petani = mysqli_query($koneksi, $sql_petani);
        $result_petani = mysqli_fetch_array($query_petani);
        // perintah untuk memindah data   
        $sql_in = "INSERT into konsultasi set
                nama_petani = '$result_petani[nama_petani]',
                alamat = '$result_petani[alamat]',
                id_penyakit = '',
                noID = '$result_petani[noID]'";
        mysqli_query($koneksi, $sql_in);

        $sql_analisa = "DELETE from tmp_analisa where noID='$noID'";
        mysqli_query($koneksi, $sql_analisa);

        $sql_delcf = "DELETE from tmp_cf where noID='$noID'";
        mysqli_query($koneksi, $sql_delcf);

        $sql_gejala = "DELETE from tmp_gejala where noID='$noID'";
        mysqli_query($koneksi, $sql_gejala);

        $sql_penyakit = "DELETE from tmp_penyakit where noID='$noID'";
        mysqli_query($koneksi, $sql_penyakit);

        $sql_petani = "DELETE from tmp_petani where noID='$noID'";
        mysqli_query($koneksi, $sql_petani);

        //redirect setelah insert data
        echo "<meta http-equiv='refresh' content='0; url=index.php?page=hasil'>";
        exit;
    }
}
?>

<html>

<head>
    <title>Form Diagnosa</title>
</head>

<body>
    <div class="container">
        <form action="?page=konsultasilanjutcek" method="post" name="form1" target="_self">
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
<?php
include "../koneksi.php";

$kdhapus = isset($_GET['kdhapus']) ? $_GET['kdhapus'] : '';

if (isset($_GET['kdhapus'])) {
    $getfile = "SELECT gambar, obat FROM penyakit WHERE id_penyakit = '$kdhapus'";
    $query = mysqli_query($koneksi, $getfile);
    $result = mysqli_fetch_array($query);

    $dir = "../image/";

    $gambarpenyakit = $result['gambar'];
    $gambarobat = $result['obat'];

    unlink($dir.$gambarpenyakit);
    unlink($dir.$gambarobat);

    $sql = "DELETE from penyakit where id_penyakit = '$kdhapus'";
    mysqli_query($koneksi, $sql)  or die("sql in error" . mysqli_error($koneksi));

    $sql2 = "DELETE from rules_penyakit where id_penyakit='$kdhapus'";
    mysqli_query($koneksi, $sql2)  or die("sql in error" . mysqli_error($koneksi));

    echo
    '<script type="text/javascript">
			//<![CDATA[
			window.location="penyakitTampil.php"
			//]]>
		</script>';
}

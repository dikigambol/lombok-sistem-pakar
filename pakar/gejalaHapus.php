<?php
    include "../koneksi.php";

    $kdhapus = isset($_GET['kdhapus']) ? $_GET['kdhapus'] : '';

    if(isset($_GET['kdhapus'])){
        $sql = "DELETE from gejala where id_gejala = '$kdhapus'";
        mysqli_query($koneksi, $sql)  or die("sql in error".mysqli_error($koneksi));

        $sql2 = "DELETE from rules_penyakit where id_gejala='$kdhapus'";
        mysqli_query($koneksi, $sql2)  or die("sql in error".mysqli_error($koneksi));

        echo 
            '<script type="text/javascript">
			//<![CDATA[
			window.location="gejalaTampil.php"
			//]]>
		</script>';
    }
?>
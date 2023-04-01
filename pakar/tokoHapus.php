<?php
    include "../koneksi.php";

    $kdhapus = isset($_GET['kdhapus']) ? $_GET['kdhapus'] : '';

    if(isset($_GET['kdhapus'])){
        $getfile = "SELECT gambar_toko FROM toko WHERE id_toko = '$kdhapus'";
        $query = mysqli_query($koneksi, $getfile);
        $result = mysqli_fetch_array($query);
    
        $dir = "../image/";
    
        $gambartoko = $result['gambar_toko'];
    
        unlink($dir.$gambartoko);

        $sql = "DELETE from toko where id_toko = '$kdhapus'";
        mysqli_query($koneksi, $sql)  or die("sql in error".mysqli_error($koneksi));
        echo 
            '<script type="text/javascript">
			//<![CDATA[
			window.location="tokoTampil.php"
			//]]>
		</script>';
    }
?>
<?php
include "koneksi.php";

# Baca variabel Form (If Register Global ON)
$txtNama = isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$txtAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
?>

<html>
    <head>
        <title>From Input Data Petani</title>
    </head>
    <body>
         <div class="section no-pad-bot" id="index-banner">
            <div class="container">
                <form action="?page=daftarSimpan" method="post" name="form1" target="_self">
                    <br><br>
                    <h6><b>Masukan data anda untuk konsultasi</b></h6>
                    <br>
                    <div class="form-group">Nama Petani:
                        <input class="form-control" name="txtNama" type="text" value="<?php echo $txtNama; ?>">
                    </div>
                    <div class="form-group">Alamat:
                        <textarea class="form-control" name="txtAlamat" value="<?php echo $txtAlamat; ?>"></textarea>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" name="Submit" value="Lanjut" class="btn-success btn-sm">Lanjut</button>
                        <button type="reset" name="reset" value="reset" class="btn-danger btn-sm">Reset</button>
                    </div>
                </form>
            <br>
            <br><br><br><br>
            </div>
        </div>
    </body>
</html>
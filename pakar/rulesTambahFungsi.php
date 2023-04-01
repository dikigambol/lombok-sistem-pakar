<?php 
    include "../koneksi.php";

    $txtKode = $_POST['txtKode'];
    $cekGejala = $_POST['cekGejala'];

    if(trim($txtKode)==''){
        echo '<div class="container">
                <div class="isi alert alert-danger role=alert">
	                <b>Kode belum dipilih, ulangi kembali</b>
                </div>
              </div>';
	include "rulesTambah.php";
    }
    else{
        $jum = count($cekGejala);
        if($jum==0){
            echo '<div class="container">
                    <div class="isi alert alert-danger role=alert">
	                    <b>Belum ada gejala yang dipilih</b>
                    </div>
                  </div>';
        }
        else{
            //untuk menghapus yang tidak dipilih lagi
            //kode untuk mendata rules yang dipilih
            $sqlpilih = "SELECT * from rules_penyakit where id_penyakit='$txtKode'";
            $querypilih = mysqli_query($koneksi, $sqlpilih);
            while($resultpilih = mysqli_fetch_array($querypilih)){
                //mengurai gejala terpilih
                for($i = 0; $i < $jum; ++$i){
                    //menghapus rules
                    if($resultpilih['id_gejala'] != $cekGejala[$i]){
                        $sqldel = "DELETE from rules_penyakit 
                                    where id_penyakit='$txtKode' 
                                    and not id_gejala
                                    in ('$cekGejala[$i]')";
                        mysqli_query($koneksi, $sqldel);
                    }
                }
            }
            // gejala data tambahan
            for ($i = 0; $i < $jum; ++$i){
                //mendapat rules
                $sqlr = "SELECT * from rules_penyakit 
                            where id_penyakit = '$txtKode'
                            and id_gejala = '$cekGejala[$i]'";
                $queryr = mysqli_query($koneksi, $sqlr);
                $resultr = mysqli_num_rows($queryr);

                //simpan gejala yang baru dipilih
                if(! $resultr == 1){
                    $sqlsimpan = "INSERT into rules_penyakit (id_penyakit, id_gejala)
                                    values ('$txtKode', '$cekGejala[$i]')";
                    mysqli_query($koneksi, $sqlsimpan);
                }
            }
            //echo konfirmasi
            echo '<div class="container">
                    <div class="isi alert alert-success role=alert">
                        <b>RULES DISIMPAN</b>
                    </div>
                  </div>';
                include "rulesTampil.php";
        }
    }
?>
<?php
    include "koneksi.php";
    //baca data dari konsultasi.php
    $rbPilih = $_REQUEST['rbPilih'];
    $txtIdGejala = $_REQUEST['txtIdGejala'];
    //get noID
    $noID = $_SERVER['REMOTE_ADDR'];

    //insert tmp_analisa
    function AddTmpAnalisa($id_gejala, $noID){
        include "koneksi.php";
        $sql_sakit = "SELECT rules_penyakit.* from rules_penyakit, tmp_penyakit
                        where rules_penyakit.id_penyakit = tmp_penyakit.id_penyakit
                        and noID='$noID' order by rules_penyakit.id_penyakit, rules_penyakit.id_gejala";
        $query_sakit = mysqli_query($koneksi, $sql_sakit);
  
         //untuk cek query
        while ($result_sakit = mysqli_fetch_array($query_sakit)){
            $sqltmp = "INSERT into tmp_analisa (noID, id_penyakit, id_gejala)
                        values ('$noID', '$result_sakit[id_penyakit]', '$result_sakit[id_gejala]')";
            mysqli_query($koneksi, $sqltmp);
        }
    }

    //insert tmp_gejala
    function AddTmpGejala($id_gejala, $noID){
        include "koneksi.php";
        $sql_gejala = "INSERT into tmp_gejala (id_gejala, noID) 
                        values ('$id_gejala', $noID')";
        mysqli_query($koneksi, $sql_gejala);
    }
    function AddcfYGejala($id_gejala, $noID){
        include "koneksi.php";
        $sql_cf = "INSERT INTO tmp_cf (id_gejala,noID,ket) 
                        VALUES ('$id_gejala','$noID','y')";
        mysqli_query($koneksi, $sql_cf);    
    }
    function AddcfNGejala($id_gejala, $noID){
        include "koneksi.php";
        $sql_cf = "INSERT INTO tmp_cf (id_gejala,noID,ket) 
                        VALUES ('$id_gejala','$noID','n')";
        mysqli_query($koneksi, $sql_cf);    
    }
    //delete tmp_penyakit
    function DelTmpPenyakit($noID){
        include "koneksi.php";
        $sql_del = "DELETE from tmp_penyakit where noID='$noID'";
        mysqli_query($koneksi, $sql_del);
    }
    //delete tmp_analisa
    function DelTmpAnalisa($noID){
        include "koneksi.php";
        $sql_del = "DELETE from tmp_analisa where noID='$noID'";
        mysqli_query($koneksi, $sql_del);
    }
    //----------------------------------------------------------------------------------------------------------

    //penalaran pertanyaan
    if ($rbPilih == "ya"){
        $sql_analisa = "SELECT * from tmp_analisa where noID='$noID'";
        $query_analisa = mysqli_query($koneksi, $sql_analisa);
        $result_analisa = mysqli_num_rows($query_analisa);
        //pada saat tmp_anasisa ada isi
        if($result_analisa >= 1){
            //penalaran pertanyaan lanjut
            DelTmpPenyakit($noID);
            $sql_tmp = "SELECT * from tmp_analisa
                        where id_gejala = '$txtIdGejala'
                        and noID = '$noID'";
            $query_tmp = mysqli_query($koneksi, $sql_tmp);
            while ($result_tmp = mysqli_fetch_array($query_tmp)){
                $sql_rsakit = "SELECT * FROM rules_penyakit
                                where id_penyakit = '$result_tmp[id_penyakit]'
                                group by id_penyakit";
                $query_rsakit = mysqli_query($koneksi, $sql_rsakit);
                            if (!$query_rsakit) {
                            printf("Error: %s\n", mysqli_error($koneksi));
                            exit();
                            } //untuk cek query
                while ($result_rsakit = mysqli_fetch_array($query_rsakit)){
                    //data penyakit yang mungkin menjangkit dimasukan ke tmp
                    $sql_input = "INSERT into tmp_penyakit (noID, id_penyakit)
                                    values ('$noID', '$result_rsakit[id_penyakit]')";
                    mysqli_query($koneksi, $sql_input);
                }
            }
            DelTmpAnalisa($noID);
            AddTmpAnalisa($txtIdGejala, $noID);
            AddTmpGejala($txtIdGejala, $noID);
            AddcfYGejala($txtIdGejala, $noID);
        }
        else{
            //kode saat tmp_analisa kosong
            $sql_rgejala = "SELECT * from rules_penyakit where id_gejala = '$txtIdGejala'";
            $query_rgejala = mysqli_query($koneksi, $sql_rgejala);
            while($result_rgejala = mysqli_fetch_array($query_rgejala)){
                $sql_rsakit = "SELECT * from rules_penyakit 
                                where id_penyakit = '$result_rgejala[id_penyakit]'
                                group by id_penyakit";
                $query_rsakit = mysqli_query($koneksi, $sql_rsakit);
                while ($result_rsakit = mysqli_fetch_array($query_rsakit)){
                    //data penyakit yang mungkin menjangkit di masukan ke tmp
                    $sql_input = "INSERT into tmp_penyakit(noID, id_penyakit)
                                    values ('$noID', '$result_rsakit[id_penyakit]')";
                    mysqli_query($koneksi, $sql_input);
                }
            }
            DelTmpAnalisa($noID);
            AddTmpAnalisa($txtIdGejala, $noID);
            AddTmpGejala($txtIdGejala, $noID);
            AddcfYGejala($txtIdGejala, $noID);
        }
        echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasilanjut'>";
    }
    if ($rbPilih == "tidak"){
        DelTmpAnalisa($noID);
        $sql_petani = "SELECT * from tmp_petani 
                            where noID='$noID'
                            order by id_petani desc
                            limit 1";
        $query_petani = mysqli_query($koneksi, $sql_petani);
        $result_petani = mysqli_fetch_array($query_petani);
        $sqlUp = "UPDATE tmp_petani
                        set 
                            id_petani = '$result_petani[id_petani]',
                            nama_petani = '$result_petani[nama_petani]',
                            alamat = '$result_petani[alamat]',
                            noID = '$result_petani[noID]',
                            ctr = '2'
                        where id_petani = $result_petani[id_petani]";
        mysqli_query($koneksi, $sqlUp) or die("sql in error".mysqli_error($koneksi));
        echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasilanjut'>";
    }
?>
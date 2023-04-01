<?php
include "koneksi.php";
//baca data dari konsultasi.php
$rbPilih = $_REQUEST['rbPilih'];
$txtIdGejala = $_REQUEST['txtIdGejala'];
//get noID
$noID = $_SERVER['REMOTE_ADDR'];

//insert tmp_analisa
function AddTmpAnalisa($id_gejala, $noID)
{
    //SQL untuk ambil data relasi dengan ketentuan kdpenyakit=kdpenyakit yg ada di dlm tmp_pnykt
    include "koneksi.php";
    $sql_sakit = "SELECT rules_penyakit.* from rules_penyakit, tmp_penyakit
                        where rules_penyakit.id_penyakit = tmp_penyakit.id_penyakit
                        and noID='$noID' order by rules_penyakit.id_penyakit, rules_penyakit.id_gejala";
    $query_sakit = mysqli_query($koneksi, $sql_sakit);
    while ($result_sakit = mysqli_fetch_array($query_sakit)) {
        // data yg didapatkan dari Query diatas, dimasukkan ke dalam tmp_analisa
        $sqltmp = "INSERT into tmp_analisa (noID, id_penyakit, id_gejala)
                        values ('$noID', '$result_sakit[id_penyakit]', '$result_sakit[id_gejala]')";
        mysqli_query($koneksi, $sqltmp);
    }
}

//insert tmp_gejala
function AddTmpGejala($id_gejala, $noID)
{
    include "koneksi.php";
    $sql_gejala = "INSERT into tmp_gejala (id_gejala, noID) 
                        values ('$id_gejala', $noID')";
    mysqli_query($koneksi, $sql_gejala);
}
function AddcfYGejala($id_gejala, $noID)
{
    include "koneksi.php";
    $sql_cf = "INSERT INTO tmp_cf (id_gejala,noID,ket) 
                        VALUES ('$id_gejala','$noID','y')";
    mysqli_query($koneksi, $sql_cf);
}
function AddcfNGejala($id_gejala, $noID)
{
    include "koneksi.php";
    $sql_cf = "INSERT INTO tmp_cf (id_gejala,noID,ket) 
                        VALUES ('$id_gejala','$noID','n')";
    mysqli_query($koneksi, $sql_cf);
}
//delete tmp_penyakit
function DelTmpPenyakit($noID)
{
    include "koneksi.php";
    $sql_del = "DELETE from tmp_penyakit where noID='$noID'";
    mysqli_query($koneksi, $sql_del);
}
//delete tmp_analisa
function DelTmpAnalisa($noID)
{
    include "koneksi.php";
    $sql_del = "DELETE from tmp_analisa where noID='$noID'";
    mysqli_query($koneksi, $sql_del);
}


//----------------------------------------------------------------------------------------------------------

//pemeriksaan jawaban penelusuran 1
//apabila jawaban ya
if ($rbPilih == "ya") {
    //periksa apakah data di tmp_analisa
    $sql_analisa = "SELECT * from tmp_analisa where noID='$noID'";
    $query_analisa = mysqli_query($koneksi, $sql_analisa);
    $result_analisa = mysqli_num_rows($query_analisa);
    if ($result_analisa >= 1) {
        //perintah apabila tmp_analisa tidak kosong
        //kosongkan dulu daftar penyakit
        DelTmpPenyakit($noID);
        //sql untuk mengambil data analisa yg kd gejala dipilih petani
        $sql_tmp = "SELECT * from tmp_analisa
                        where id_gejala = '$txtIdGejala'
                        and noID = '$noID'";
        $query_tmp = mysqli_query($koneksi, $sql_tmp);
        while ($result_tmp = mysqli_fetch_array($query_tmp)) {
            //sql untuk ambil data relasi yg kd penyakit didlm tb tmp_analisa
            $sql_rsakit = "SELECT * FROM rules_penyakit
                                where id_penyakit = '$result_tmp[id_penyakit]'
                                group by id_penyakit";
            $query_rsakit = mysqli_query($koneksi, $sql_rsakit);
            if (!$query_rsakit) {
                printf("Error: %s\n", mysqli_error($koneksi));
                exit();
            } //untuk cek query
            while ($result_rsakit = mysqli_fetch_array($query_rsakit)) {
                //hasil query dipindahkan ke tb tmp_penyakit
                //jadi hanya penyakit yg mungkin
                //data penyakit yang mungkin menjangkit dimasukan ke tmp
                $sql_input = "INSERT into tmp_penyakit (noID, id_penyakit)
                                    values ('$noID', '$result_rsakit[id_penyakit]')";
                mysqli_query($koneksi, $sql_input);
            }
        }
        // memanggil fungsi
        DelTmpAnalisa($noID);
        // fungsi mengisidata
        AddTmpAnalisa($txtIdGejala, $noID);
        AddTmpGejala($txtIdGejala, $noID);
        AddcfYGejala($txtIdGejala, $noID);
    } else {
        //kode saat tmp_analisa kosong

        //sql untuk mengambil data relasi yg kdgejala dipilih oleh pasien
        $sql_rgejala = "SELECT * from rules_penyakit where id_gejala = '$txtIdGejala'";
        $query_rgejala = mysqli_query($koneksi, $sql_rgejala);
        while ($result_rgejala = mysqli_fetch_array($query_rgejala)) {
            //ambil data relasi yg kdpenyakit sesuai dgn query sebelumnya(relasi)
            $sql_rsakit = "SELECT * from rules_penyakit 
                                where id_penyakit = '$result_rgejala[id_penyakit]'
                                group by id_penyakit";
            $query_rsakit = mysqli_query($koneksi, $sql_rsakit);
            while ($result_rsakit = mysqli_fetch_array($query_rsakit)) {
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
    } //redireksi
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasi'>";
}

//apabila tidak
if ($rbPilih == "tidak") {
    //ambil dari semua data dari tmp analisa
    $sql_analisa = "SELECT * from tmp_analisa where noID='$noID'";
    $query_analisa = mysqli_query($koneksi, $sql_analisa);
    $result_analisa = mysqli_num_rows($query_analisa);
    if ($result_analisa >= 1) {
        AddcfNGejala($txtIdGejala, $noID);
        //apabila data tmpanalisa tdk kosong
        // hapus tmpanalisa yg tdk sesuai
        //ambil data kdpenyakit yg dipilih dari tb tmpanalisa, syarat yg gejala telah dipilih
        $sql_analisa2 = "SELECT * from tmp_analisa where id_gejala='$txtIdGejala'";
        $query_analisa2 = mysqli_query($koneksi, $sql_analisa2);
        while ($result_analisa2 = mysqli_fetch_array($query_analisa2)) {
            //perintah hapus tmpanalisa dari data kdpenyakit yg didapat
            $sql_deltmp = "DELETE from tmp_analisa
                                where id_penyakit = '$result_analisa2[id_penyakit]'
                                and noID='$noID'";
            mysqli_query($koneksi, $sql_deltmp);

            //hapus dafrar penyakit yang sudah tidak mungkin menjangkit
            $sql_deltmp2 = "DELETE from tmp_penyakit
                                where id_penyakit = '$result_analisa2[id_penyakit]'
                                and noID='$noID'";
            mysqli_query($koneksi, $sql_deltmp2);
        }

        $sql_cek0 = "SELECT * from tmp_analisa where noID='$noID' group by id_penyakit";
        $query_cek0 = mysqli_query($koneksi, $sql_cek0);
        $result_cek0 = mysqli_num_rows($query_cek0);

        if ($result_cek0 == 0) {
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

            function Deltmpcf($noID)
            {
                include "koneksi.php";
                $sql_delcf = "DELETE from tmp_cf where noID='$noID'";
                mysqli_query($koneksi, $sql_delcf);
            }
            //redirect setelah insert data
            echo "<meta http-equiv='refresh' content='0; url=index.php?page=hasil'>";
            exit;
        } else {
            echo "<meta http-equiv='refresh' content='0; url=index.php?page=konsultasi'>";
        }
    }
}

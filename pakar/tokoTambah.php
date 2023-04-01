<?php
    include "../session.php";
    include "../koneksi.php";
    
    $txtKode = isset($_POST['txtKode']) ? $_POST['txtKode'] : '';
    $txtToko = isset($_POST['txtToko']) ? $_POST['txtToko'] : '';
    $txtAlamatToko = isset($_POST['txtAlamatToko']) ? $_POST['txtAlamatToko'] : '';
    $txtNomorTelepon = isset($_POST['txtNomorTelepon']) ? $_POST['txtNomorTelepon'] : '';
    $txtGambarToko = isset($_POST['txtGambarToko']) ? $_POST['txtGambarToko'] : '';
    $txtMapToko = isset($_POST['txtMapToko']) ? $_POST['txtMapToko'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Sistem Pakar</title>
  <!-- SCRIPT -->
  <script src="../js/vue.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script type="../text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="../text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- CSS  -->
  <link href="../css/bootstrap.css" type="text/css" rel="stylesheet" media="screen, projection"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
    <nav class="blue" role="navigation">
        <div class="nav-wrapper container "><a id="logo-container" href="index.php" class="brand-logo">ADMIN</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="penyakitTampil.php">Data Penyakit</a></li>
                <li><a href="gejalaTampil.php">Data Gejala</a></li>
                <li><a href="rulesTampil.php">Data Rules</a></li>
                <li><a href="tokoTampil.php">Data Toko</a></li>
                <li><a href="logout.php" onclick="return confirm('Anda Yakin Ingin Logout..?');" target="_self">Logout</a></li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li><a href="penyakitTampil.php">Data Penyakit</a></li>
                <li><a href="gejalaTampil.php">Data Gejala</a></li>
                <li><a href="rulesTampil.php">Data Rules</a></li>
                <li><a href="tokoTampil.php">Data Toko</a></li>
                <li><a href="logout.php" onclick="return confirm('Anda Yakin Ingin Logout..?');" target="_self">Logout</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <!--isi-->
    <div class="col-md-12 blue lighten-5">
        <div class="section no-pad-bot container" id="index-banner">
            <div>
                <h3 class="header center">Tambah Toko</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 #e3f2fd blue lighten-5">
        <div class="col-md-8 col-md-offset-2 content">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <b>Tambah Data Toko</b>
                </div>
                <div class="panel-body">
                  <form name="form1" method="post" enctype='multipart/form-data' action="tokoTambahFungsi.php">
                    <table class="table">
                      <tr>
                        <td width="135">Nama Toko</td>
                        <td width="450">
                          <input name="txtToko" type="text" size="60" maxlength="30">
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat Toko</td>
                        <td>
                          <textarea name="txtAlamatToko" cols="50" rows="4"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>Nomor Telepon</td>
                        <td>
                        <input name="txtNomorTelepon" type="number" size="60" maxlength="30">
                        </td>
                      </tr>
                      <tr>
                        <td>Foto Toko</td>
                        <td>
                        <input name="txtGambarToko" type="file">
                        </td>
                      </tr>
                      <tr>
                        <td>Link Google Map Toko</td>
                        <td>
                        <textarea name="txtMapToko" cols="50" rows="4"></textarea>
                        </td>
                      </tr>

                      <tr>
                        <td>&nbsp;</td>
                        <td class="right">
                          <input class="btn-sm btn-success raised" type="submit" name="Submit" value="Simpan">
                          <input class="btn-sm btn-danger raised" type="reset" name="Reset" value="Reset">
                        </td>
                      </tr>
                    </table>
                  </form>
                </div>
            </div>
        </div>
    </div>
     <footer class="page-footer blue">
      <div class="container"> 
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Mochammad Said Abdurrahman</h5>
            <p class="grey-text text-lighten-4">Saya adalah mahasiswa prodi teknik informatika yang sedang mengambil tugas akhir dan aplikasi ini adalah judul yang saya angkat sebagai tugas akhir.</p>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text"></h5>
            <ul>
              <li><a class="white-text" href="#!"></a></li>
              <li><a class="white-text" href="#!"></a></li>
            </ul>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Contact</h5>
            <ul>
              <li><a class="white-text" href="https://api.whatsapp.com/send?phone=082143668971" target="_blank">WhatsApp</a></li>
             <li><a class="white-text" href="http://msaidabdurrahman99@gmail.com" target="_blank">Email</a>
            </ul>
          </div>
        </div>
      </div>
      </div>
    </footer>
  </body>
</html>
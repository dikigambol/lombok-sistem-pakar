<?php
include "../session.php";
include "../koneksi.php";
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
                <h3 class="header center">Pengelola Data Rules</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 #e3f2fd blue lighten-5">
        <div class="col-md-10 col-md-offset-1 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Data Rules Penyakit</b>
                    <?php 
                        $sql = "SELECT * from rules_penyakit";
                        $query = mysqli_query($koneksi, $sql);
                        $row = mysqli_num_rows($query);
                        $no = 1;
                        echo "<p>Jumlah rules/aturan saat ini ada $row rules</p>";
                    ?>
                    <br>
                    <a href="rulesTambah.php" class="btn-sm btn-success" target="_self">Kelola</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="table">
                        <tr>
                            <th width="28">No</th>
                            <th width="70" class="center">Kode Penyakit</th>
                            <th width="70" class="center">Kode Gejala</th>
                            <th>Nama Penyakit</th>
                            <th>Nama Gejala</th>
                            <!--th class="center">keyakinan</th>
                            <th class="center">Ketidakyakinan</th>
                            <th class="center">CB</th-->
                            <th></th>
                        </tr>
                        <?php
                            $sql = "SELECT rules_penyakit.*, penyakit.nama_penyakit, gejala.nama_gejala 
                                    from rules_penyakit, gejala, penyakit 
                                    where gejala.id_gejala = rules_penyakit.id_gejala
                                    and  penyakit.id_penyakit = rules_penyakit.id_penyakit
                                    order by id_penyakit, id_gejala";
                            $query = mysqli_query($koneksi, $sql);
                            $no = 0;
                            while($result = mysqli_fetch_array($query)){
                                $no++;
                        ?>
                        <tr>
                            <td class="center"><?php echo $no;?></td>
                            <td style="text-align: center"><?php echo $result['id_penyakit'];?></td>
                            <td style="text-align: center"><?php echo $result['id_gejala'];?></td>
                            <td><?php echo $result['nama_penyakit'];?></td>
                            <td><?php echo $result['nama_gejala'];?></td>
                            <!--td class="center"><?php //echo $result['keyakinan'];?></td>
                            <td class="center"><?php //echo $result['ketidakyakinan'];?></td>
                            <td class="center"><?php //echo $result['CB'];?></td-->
                            <td class="right">
                            <!--a class="btn-xs btn-success raised" href="rulesEdit.php?kdubah=<?php echo $result['id_rules']; ?>" target="_self">Edit</a>
                            </td-->
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
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
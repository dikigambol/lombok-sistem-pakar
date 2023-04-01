<?php 
    include "koneksi.php";
?>

<html>
  <head>
      <title>Data Penyakit</title>
  </head>
  <body>
  <div class="section no-pad-bot" id="index-banner" v-if="mulai">
          <div class="container">
              <h3 class="header center">Daftar Penyakit</h3>
              <div class="row">
                  <?php include 'koneksi.php';
                      $query = "SELECT*FROM  penyakit where id_penyakit != '000' ORDER BY id_penyakit ASC";
                      $result = mysqli_query ($koneksi, $query);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row = mysqli_fetch_array($result))
                        {
                  ?>
                        <div class="col-md-6">
                            <div class="text-justify">
                                  <div style="border:1px solid #000; border-radius:5px; margin-bottom:10px; padding:0px 10px 0px 10px">
                                      <img src="image/<?php echo $row ["gambar"];?>" class="col-md-12" style="height:300px; margin:15px 0px"><br>
                                      <h5 class="center"><?php echo $row ["nama_penyakit"];?></h5>
                                      <p><b>Informasi Penyakit:</b></p>
                                      <p class="text-danger"><?php echo $row ["info_penyakit"];?></p><br>
                                      <p><b>Gejala:</b></p>
                                        <ul>
                                          <?php include 'koneksi.php';
                                          $idpenyakit = $row['id_penyakit'];
                                          $gejalaQue = "SELECT DISTINCT nama_gejala
                                          FROM rules_penyakit
                                          JOIN gejala ON rules_penyakit.id_gejala = gejala.id_gejala
                                          JOIN penyakit ON rules_penyakit.id_penyakit = penyakit.id_penyakit
                                          WHERE rules_penyakit.id_penyakit = '$idpenyakit'";
                                          $gejalaRes = mysqli_query ($koneksi, $gejalaQue);
                                          if(mysqli_num_rows($gejalaRes)>0)
                                          {
                                            while($gejalaRow = mysqli_fetch_array($gejalaRes))
                                            {?>
                                              <li> - <?php echo $gejalaRow ["nama_gejala"];?></li>
                                              <?php
                                            }
                                          }
                                          ?>
                                          
                                        </ul>
                                  </div>
                            </div>
                        </div>
                  <?php            
                          }
                      }
                  ?>
              </div>
              <br><br>
          </div>
      </div>
  </body>
</html>
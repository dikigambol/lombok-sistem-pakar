<?php
include "koneksi.php";
?>

<html>

<head>
  <title>Toko Obat Pertanian</title>
</head>

<body>
  <div class="container">
    <h3 class="header center">Toko Obat Pertanian</h3>
    <br>
    <div class="media">
      <?php include 'koneksi.php';
      $query = "SELECT*FROM  toko where id_toko != '000' ORDER BY id_toko ASC";
      $result = mysqli_query($koneksi, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
      ?>
          <a class="media-left">
            <img src="image/<?php echo $row["gambar_toko"]; ?>" class="coeg" height="180px" width="180px">
          </a>
          <div class="media-body">
            <h5 class="media-heading"><b><?php echo $row["nama_toko"]; ?></b></h5>
            <br>
            <p> &nbsp; &nbsp; <img src="image/map.png" width="30px"> &nbsp; &nbsp; : <a href="<?php echo $row["map_toko"]; ?>" target="_blank">
                <?php echo $row["alamat_toko"]; ?>
            </p> </a>
            <p>
              <a href="https://api.whatsapp.com/send?phone=<?php echo $row["nomor_telepon"]; ?>" target="_blank"> <img src="image/wa.png" width="60px"> : <?php echo $row["nomor_telepon"]; ?>
              </a>
            </p>
          </div>
          <br>
          <br>
      <?php
        }
      }
      ?>
    </div>
    <br>
    <div class="row center">
      <a href="index.php?page=daftartoko" id="daftartoko" class="btn-lg waves-effect waves-light green noatt white-text">Daftarkan Toko Obat Anda Disini</a>
    </div>
  </div>
  <br>
</body>

</html>
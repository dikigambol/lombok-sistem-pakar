<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Sistem Pakar</title>
    <!-- SCRIPT -->
    <script src="js/vue.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        function myFunction() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "block") {
            x.style.display = "none";
          } else {
            x.style.display = "block";
          }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- CSS  -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="screen, projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <style>
      #myDIV {
        text-align: center;
        padding-right: 115px;
        display: none;
      }
      div.relative {
        position: relative;
        width: 400px;
        height: 200px;
        border: 3px solid #73AD21;
      } 

      div.absolute {
        position: absolute;
        top: 80px;
        right: 0;
        width: 400px;
        height: 100px;
        z-index: 10;
      }
      div.sticky{
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
        background-color: green;
      }
    </style>
  </head>
  <body>
    <nav class="green" role="navigation">
      <div class="nav-wrapper container "><a id="logo-container" href="index.php?page=home" class="brand-logo">Sistem Pakar</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="?page=daftar" class="noatt white-text">Konsultasi</a></li>
          <li><a href="?page=daftarPenyakit" class="noatt white-text">Info Penyakit</a></li>
          <li><a href="?page=datatoko" class="noatt white-text">Toko Obat</a></li>
          <li><a onclick="myFunction()" class="noatt white-text">Admin</a></li>
        </ul>

        <ul id="nav-mobile" class="sidenav">
          <li><a href="?page=daftar">Konsultasi</a></li>
          <li><a href="?page=daftarPenyakit">Info Penyakit</a></li>
          <li><a href="?page=datatoko">Data Toko</a></li>
          <li><a onclick="myFunction()">Admin</a></li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>
    </nav>
    <div class="absolute" id="myDIV">
      <div class="col-md-11">
        <form action="loginCek.php"  method="post" class="navbar-form navbar-right form-inline blue lighten-5" role="form" style="border: 2px solid red; border-radius: 15px 50px;">
          <h5>Form Login Admin</h5><br>
          <div class="form-group">
            <input type="text" name="txtUser" class="form-control" placeholder="Username" autofocus required/>
          </div><br>
          <div class="form-group">
          <input type="password" name="txtPass" class="form-control" placeholder="Password" required/>
          </div><br>
          <input type="submit" class="btn-danger btn-sm right" value="Login"><br><br>
        </form>
      </div>
    </div>
    <div>
      <?php include "route.php";?>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>
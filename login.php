<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Netship</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      background: url(assets/img/latar_belakang.jpg) no-repeat center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    body > .container {
      margin-top: 60px;
    }
    .container {
      z-index: 100;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span>NETSHIP</h3>
        </div>
        <div class="panel-body">
          <center>
            <img src="assets/img/network.png" class="img-circle" alt="logo" width="120px">
          </center>
          <hr>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include "koneksi.php";  // Make sure this file exists and is correct

            $user = $_POST['username'];
            $pass = $_POST['password'];
            $p = md5($pass);

            if ($user == '' || $pass == '') {
          ?>
              <div class="alert alert-warning"><b>Warning!</b> Form anda belum lengkap!</div>
          <?php
            } else {
              $sqlLogin = mysqli_query($konek, "SELECT * FROM admin WHERE username='$user' AND password='$p'");
              
              if (!$sqlLogin) {
                echo "Error executing query: " . mysqli_error($konek);
              } else {
                $jml = mysqli_num_rows($sqlLogin);

                if ($jml > 0) {
                  $d = mysqli_fetch_array($sqlLogin);
                  session_start();
                  $_SESSION['login'] = TRUE;
                  $_SESSION['Id'] = $d['idadmin'];
                  $_SESSION['username'] = $d['username'];
                  $_SESSION['namalengkap'] = $d['namalengkap'];

                  header('Location: ./index.php');
                } else {
          ?>
                  <div class="alert alert-danger"><b>ERROR</b> Username dan Password anda Salah!</div>
          <?php
                }
              }
            }
          }
          ?>
          <form action="" method="post" role="form">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

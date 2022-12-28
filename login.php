<?php
require('koneksi.php');
session_start();

if (isset ($_SESSION["login"])){
  header("Location: index.php");
  exit;
}
if (isset($_POST['submit'])) {
  $username = $_POST['email'];
  $pass = $_POST['password'];
  $Email = $_POST['Email'];
  echo $username . $pass . $Email ;
  
  
  if (!empty($username) && !empty($pass)) {
    $query = "SELECT * FROM akun WHERE Username = '$username'";
    $result = mysqli_query($koneksi, $query);
    $num = mysqli_num_rows($result);

    while ($row = mysqli_fetch_array($result)) {
      $userName = $row['Username'];
      $passVal = $row['Password'];

      if ($num != 0) {
        if ($userName == $username && $passVal == $pass) {
          $_SESSION['username'] = $userName;
          header('Location: index.php');
          echo $error;
        } else {
          $error = 'user atau password salah';
          // header('Location: login.php');
          echo $error;
        }
      } else {
        $error = 'User tidak ditemukan!';
        //header('Location: login.php');
        echo $error;
      }
    }
  } else {
    $error = "Data tidak boleh kosong!";
    echo $error;
  }
  $_SESSION["login"] = true;
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="style.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>

  <body>

    <div class="login-root">

      <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
        <div class="loginbackground box-background--white padding-top--64">
          <div class="loginbackground-gridContainer">
            <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
              <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
              </div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
              <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
              <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
              <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
              <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
              <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
              <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
              <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
            </div>
            <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
              <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
            </div>
          </div>
        </div>
        <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">

          <div class="formbg-outer">
            <div class="formbg">
              <div class="formbg-inner padding-horizontal--48">
                <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
                  <img src="logo.png" style="width: 150px;">

                </div>
                <!-- <h4><a rel="" style="text-align: center;">Selamat Datang di Ofee</a></h4> -->
                <form id="stripe-login" method="POST" action="login.php">
                  <div class="field padding-bottom--24">
                    <label for="Username">Username</label>
                    <input type="text" name="email" placeholder="Masukkan Username">
                  </div>
                  <div class="field padding-bottom--24">
                    <div class="grid--50-50">
                      <label for="password">Password</label>

                    </div>
                    <input type="password" name="password" placeholder="Masukkan Password">
                  </div>

                  <div class="field padding-bottom--24">
                    <input type="submit" name="submit" value="Login">
                  </div>

                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </body>

</html>
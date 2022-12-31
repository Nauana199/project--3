<?php

require '../koneksi.php';

$row = showData();
if (isset($_POST['submit_edit'])) {
  UpdateData();
  echo 'submit edit submitted';
}

function showData()
{
  if (isset($_GET['kode_menu'])) {
    $sql = "SELECT * FROM menu WHERE kode_menu = '" . $_GET['kode_menu'] . "'";
    $koneksi = mysqli_connect('localhost', 'root', '', 'project3');
    $result = mysqli_query($koneksi, $sql);
    return mysqli_fetch_array($result);
  } else {
    header('Location: ../menu/index.php');
  }
}

function UpdateData()
{
  $koneksi = mysqli_connect('localhost', 'root', '', 'project3');

  $kodeProduk = $_POST['kode_produk'];
  $namaProduk = $_POST['nama_produk'];
  $harga = $_POST['harga_produk'];
  $kodeToko = $_POST['kode_toko'];
  $deskripsi = $_POST['deskripsi_produk'];
  $kategori_menu = $_POST['kategori_menu'];

  if (isset($_FILES['gambar_menu'])) {
    $ext_file = pathinfo($_FILES['gambar_menu']['name'], PATHINFO_EXTENSION);
    $nama_file_baru = 'image_berita_' . $kodeProduk . '.' . $ext_file;

    if (is_file('../images/menu_images/' . $nama_file_baru)) unlink('../images/menu_images/' . $nama_file_baru);

    $tmp_file = $_FILES['gambar_menu']['tmp_name'];

    if ($ext_file == "jpg" || $ext_file == "jpeg" || $ext_file == "png") {

      $sql = "UPDATE menu SET Nama_Menu = '$namaProduk', Harga='$harga', Kode_Toko='$kodeToko', deskripsi = '$deskripsi', gambar = '$nama_file_baru' WHERE kode_menu = '$kodeProduk'";
      mysqli_query($koneksi, $sql);

      move_uploaded_file($tmp_file, '../images/menu_images/' . $nama_file_baru);
      header('Location: ../menu/index.php');
    }
  }
  $sql = "UPDATE menu SET Nama_Menu = '$namaProduk', Harga='$harga', Kode_Toko='$kodeToko', deskripsi = '$deskripsi', kategori_menu='$kategori_menu' WHERE kode_menu = '$kodeProduk'";
  mysqli_query($koneksi, $sql);
  header('Location: ../menu/index.php');
}

function ifOptionSelected($data, $selectedData)
{
  if ($data == $selectedData) {
    return true;
  }
  return false;
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Menu</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <script src="https://kit.fontawesome.com/64d58efce2.js"></script>
</head>

<body>
  <div class="container">
    <span class="big-circle"></span>

    <div class="form">

      <!-- KOTAK SEBELAH KIRI -->
      <form action="ubah_menu.php" method="POST" enctype="multipart/form-data">
        <div class="contact-form">

          <!-- HIASAN -->
          <span class="circle one"></span>
          <span class="circle two"></span>

          <!-- FORM INPUT -->
          <div class="form-input-container">
            <h3 class="title">Atur Menu</h3>

            <div class="input-container">
              <input type="text" name="kode_toko" class="input" />
              <label for="">Kode Toko</label>
              <span>Kode Toko</span>
            </div>
            <div class="input-container">
              <input type="text" name="nama_produk" class="input" />
              <label for="">Nama Produk</label>
              <span>Nama Produk</span>
            </div>
            <div class="input-container">
              <input type="number" name="harga_produk" class="input" />
              <label for="">Harga</label>
              <span>Harga</span>
            </div>
            <div class="input-container textarea">
              <textarea name="deskripsi_produk" class="input"></textarea>
              <label for="">Deskripsi Produk</label>
              <span>Deskripsi Produk</span>
            </div>
            <div class="input-container">
              <select class="input" style="color: white;" name="kategori_menu">
                <option selected>Kategori</option>
                <option value="MAKANAN" style="color: black;"> Makanan </option>
                <option value="MINUMAN" style="color: black;"> Minuman </option>
                <option value="PAKET" style="color: black;"> Paket Hemat </option>
              </select>
            </div>
            <div class="input-container">
              <input name="gambar_menu" class="input" type="file">
            </div>



            <!-- SUBMIT -->
            <input type="submit" value="submit" class="btn" name="submit_insert" />
      </form>
    </div>
  </div>
  </div>
  </div>
  <script src="app.js"></script>
  <script src="main.js"></script>

</body>

</html>
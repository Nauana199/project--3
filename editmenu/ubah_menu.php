<?php

require '../config/koneksi.php';

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
      <div class="contact-info">
        <!-- EDITOR PANEL -->
        <div class="editor-panel">
          <div class="filter">
            <!-- <label class="title">Filter</label>
            <div class="options">
              <button id="brightness" class="active">Kecerahan</button>
              <button id="saturation">Kejenuhan</button>
              <button id="inversion">Negatif</button>
              <button id="grayscale">Hitam Putih</button>
            </div> -->
            <div class="slider">
              <!-- <div class="filter-info">
                <p class="name">Kecerahan</p>
                <p class="value">100%</p>
              </div> -->
              <input type="range" value="100" min="0" max="200" hidden />
            </div>
          </div>
        </div>
        <!-- ROTASI -->
        <!-- <div class="rotate">
          <label class="title">Putar & Balik</label>
          <div class="options">
            <button id="left"><i class="fa-solid fa-rotate-left"></i></button>
            <button id="right">
              <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button id="horizontal">
              <i class="bx bx-reflect-vertical"></i>
            </button>
            <button id="vertical">
              <i class="bx bx-reflect-horizontal"></i>
            </button>
          </div>
        </div> -->
        <div>
          <div class="preview-img">
            <img src="pilihgambar.jpg" alt="preview-img" />
          </div>
        </div>
        <div class="controls">
          <button class="reset-filter" hidden>Atur Ulang</button>
          <div class="row">
            <input type="file" class="file-input" accept="image/*" hidden />
            <button class="choose-img">Pilih Gambar</button>
            <button class="save-img" hidden>Simpan Gambar</button>
          </div>
        </div>
      </div>
      <!-- KOTAK SEBELAH KIRI -->
      <div class="contact-form">

        <!-- HIASAN -->
        <span class="circle one"></span>
        <span class="circle two"></span>

        <!-- FORM INPUT -->
        <form action="ubah_menu.php?kode_menu=<?= $row['Kode_Menu'] ?>" method="POST" enctype="multipart/form-data">
          <h3 class="title">Atur Menu</h3>
          <div class="input-container">
            <input type="text" name="kode_produk" class="input" value="<?= $row['Kode_Menu'] ?>" readonly />
            <label for="">Kode Menu</label>
            <span>Kode Menu</span>
          </div>
          <div class="input-container">
            <input type="text" name="kode_toko" class="input" value="<?= $row['Kode_Toko'] ?>" />
            <label for="">Kode Toko</label>
            <span>Kode Toko</span>
          </div>
          <div class="input-container">
            <input type="text" name="nama_produk" class="input" value="<?= $row['Nama_Menu'] ?>" />
            <label for="">Nama Menu</label>
            <span>Nama Menu</span>
          </div>
          <div class="input-container">
            <input type="number" name="harga_produk" class="input" value="<?= $row['Harga'] ?>" />
            <label for="">Harga</label>
            <span>Harga</span>
          </div>
          <div class="input-container textarea">
            <textarea name="deskripsi_produk" class="input"><?= $row['deskripsi'] ?></textarea>
            <label for="">Deskripsi Produk</label>
            <span>Deskripsi Produk</span>
          </div>
          <div class="input-container option">
            <select class="input" style="color: black;" name="kategori_menu">
              <option selected>Kategori</option>
              <option value="MAKANAN" <?= ((ifOptionSelected("MAKANAN", $row['kategori_menu'])) ? 'selected = "selected"' : "") ?>> Makanan </option>
              <option value="MINUMAN" <?= ((ifOptionSelected("MINUMAN", $row['kategori_menu'])) ? 'selected="selected"' : "") ?>> Minuman </option>
              <option value="PAKET" <?= ((ifOptionSelected("PAKET", $row['kategori_menu'])) ? 'selected="selected"' : "") ?>> Paket </option>
            </select>
          </div>
          <div class="input-container">
            <input name="gambar_menu" class="input" type="file">
          </div>
          <!-- COBA -->
          <div class="note">

            <!-- <div class="titlee">
              <h3>Tambah Toping</h3>
              <div class="note-wrapper">

                <textarea name="message" class="input" type="text" id="note-title"></textarea>
                <button type="button" class="btn" id="add-note-btn">
                  <span><i class="fas fa-plus"></i></span>
                  Add Note
                </button>
              </div>
            </div>

            <div class="note-list">
              <button type="button" class="btn" id="delete-all-btn">
                <span><i class="fas fa-trash"></i></span>
                Delete All
              </button>
            </div> -->
            <!-- SUBMIT -->
            <input type="submit" value="submit" class="btn" name="submit_edit" />
        </form>
      </div>
    </div>
  </div>
  <script src="app.js"></script>
  <script src="main.js"></script>

</body>

</html>
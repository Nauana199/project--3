<?php

require '../config/koneksi.php';

if (isset($_POST['submit_insert'])) {
  InsertData();
}

function countGenerator($numb)
{
  $numb++;
  if (strlen($numb) > 5) {
    return $numb;
  } else if (strlen($numb) > 4) {
    $numb = "0" . $numb;
    return $numb;
  } else if (strlen($numb) > 3) {
    $numb = "00" . $numb;
    return $numb;
  } else if (strlen($numb) > 2) {
    $numb = "000" . $numb;
    return $numb;
  } else if (strlen($numb) > 1) {
    $numb = "0000" . $numb;
    return $numb;
  } else if (strlen($numb) > 0) {
    $numb = "00000" . $numb;
    return $numb;
  }
}
function idMenuGenerator()
{
  $koneksi = mysqli_connect('localhost', 'root', '', 'project3');

  $sql = "SELECT Kode_Menu FROM menu ORDER BY Kode_Menu DESC";
  $result = mysqli_query($koneksi, $sql);
  if ($row = $result->fetch_array()) {
    $countIDs = substr($row['Kode_Menu'], 2);
    $newIDs = "KM" . countGenerator($countIDs);
    return $newIDs;
  } else {
    $newIDs = "KM000001";
    return $newIDs;
  }
}


function InsertData()
{
  $koneksi = mysqli_connect('localhost', 'root', '', 'project3');

  $kodeProduk = $_POST['kode_produk'];
  $namaProduk = $_POST['nama_produk'];
  $harga = $_POST['harga_produk'];
  $kodeToko = $_POST['kode_toko'];
  $deskripsi = $_POST['deskripsi_produk'];
  $kategoriMenu = $_POST['kategori_menu'];

  $ext_file = pathinfo($_FILES['gambar_menu']['name'], PATHINFO_EXTENSION);
  $nama_file_baru = 'image_berita_' . $kodeProduk . '.' . $ext_file;

  if (is_file('../images/menu_images/' . $nama_file_baru)) unlink('../images/menu_images/' . $nama_file_baru);

  $tmp_file = $_FILES['gambar_menu']['tmp_name'];

  if ($ext_file == "jpg" || $ext_file == "jpeg" || $ext_file == "png") {

    $sql = "INSERT INTO menu (Kode_Menu, Nama_Menu, Harga, Kode_Toko, deskripsi, kategori_menu, gambar) 
    VALUES ('$kodeProduk', '$namaProduk','$harga', '$kodeToko', '$deskripsi', '$kategoriMenu', '$nama_file_baru')";
    mysqli_query($koneksi, $sql);

    move_uploaded_file($tmp_file, '../images/menu_images/' . $nama_file_baru);
    header('Location: ../menu/index.php');
  }
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
        <form action="tambah_menu.php" method="POST" enctype="multipart/form-data">

          <div class="controls">
            <button class="reset-filter" hidden>Atur Ulang</button>
            <div class="row">
              <input type="file" class="file-input" name='gambar_menu' accept="image/*" hidden />
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
        <div class="form-input-container">
          <h3 class="title">Atur Menu</h3>
          <div class="input-container">
            <input type="text" name="kode_produk" class="input" value="<?= idMenuGenerator() ?>" hidden />
          </div>
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
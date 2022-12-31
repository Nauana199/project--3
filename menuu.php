<?php

require 'koneksi.php';

function ifOptionSelected($data, $selectedData)
{
  if ($data == $selectedData) {
    return true;
  }
  return true;
}
function filterKategori($data)
{
  $kategoriClass = "";
  if ($data == "MAKANAN") {
    $kategoriClass = "featured";
  } else if ($data == "MINUMAN") {
    $kategoriClass = "today-special";
  } else if ($data == "PAKET") {
    $kategoriClass = "new-arrival";
  }
  return $kategoriClass;
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Food Menu</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/menu.css" />
  <!-- fontawesome icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <section class="menu">
    <div class="menu-container">
      <div class="menu-head">
        <h2>Menu</h2>

        <p></p>
      </div>

      <div class="menu-btns">
        <button type="button" class="menu-btn active-btn" id="featured">
          Makanan
        </button>
        <button type="button" class="menu-btn" id="today-special">
          Minuman
        </button>
        <button type="button" class="menu-btn" id="new-arrival">
          Paket Hemat
        </button>
        <a href="editmenu/tambah_menu.php">
          <button type="button" class="button">
            <span class="button__text">Tambah Menu</span>
            <span class="button__icon">
              <ion-icon name="add-outline"></ion-icon>
            </span>
          </button>
        </a>
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
      </div>

      <div class="food-items">
        <!-- MAKANAN -->
        <?php

        $query = "SELECT * FROM menu";
        $result = mysqli_query($koneksi, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo '
          <div class=" food-item ' . (filterKategori($row['kategori_menu'])) . '">
          <div class="food-img">
            <img src="images/menu_images/' . $row['gambar'] . '" alt="food image" />
          </div>
          <div class="food-content">
            <div class="description">
              <h2 class="food-name">' . $row['Nama_Menu'] . '</h2>
              <div class="line"></div>
              <h3 class="food-price">RP ' . $row['Harga'] . '</h3>

              <p class="deskripsi">Deskripsi: <span>' . $row['deskripsi'] . '</span></p>
            </div>
            <!-- COBA -->

            <!-- COBA -->
            <div class="icons">
              <a href="editmenu/ubah_menu.php?kode_menu=' . $row['Kode_Menu'] . '"><i class="fas fa-edit" style="font-size: 24px"></i></a>
              <a href="hapus_menu.php?kode=' . $row['Kode_Menu'] . '"><i class="fas fa-trash-alt" style="font-size: 24px"></i></a>
            </div>
          </div>
        </div>
          ';
        }

        ?>





      </div>
    </div>
  </section>

  <script src="js/script.js"></script>
</body>

</html>
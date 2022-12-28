<?php
require 'koneksi.php';

$kode_menu = $_GET['kode'];

$sql = "DELETE FROM menu WHERE Kode_Menu = '$kode_menu'";
mysqli_query($koneksi, $sql);

header('Location:menuu.php');

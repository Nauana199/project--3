<?php
require 'koneksi.php';

$kode_menu = $_GET['kode'];

$sql = "SELECT * FROM menu WHERE Kode_Menu = '$kode_menu'";
$result = mysqli_query($koneksi, $sql);
$row = $result->fetch_array();

unlink('images/menu_images/' . $row['gambar']);

$sql = "DELETE FROM menu WHERE Kode_Menu = '$kode_menu'";
mysqli_query($koneksi, $sql);

header('Location:menuu.php');

<?php
session_start();

if (isset($_POST['submit_insert'])) {
    InsertData();
}

function countGenerator($numb)
{
    $numb++;
    if (strlen($numb) > 1) {

        return $numb;
    } else if (strlen($numb) > 0) {
        $numb = "0" . $numb;
        return $numb;
    }
}
function idBannerGenerator()
{
    $koneksi = mysqli_connect('localhost', 'root', '', 'project3');

    $sql = "SELECT Kode_Banner FROM banner ORDER BY Kode_Banner DESC";
    $result = mysqli_query($koneksi, $sql);
    if ($row = $result->fetch_array()) {
        $countIDs = substr($row['Kode_Banner'], 1);
        $newIDs = "A" . countGenerator($countIDs);
        return $newIDs;
    } else {
        $newIDs = "A01";
        return $newIDs;
    }
}

function InsertData()
{
    $koneksi = mysqli_connect('localhost', 'root', '', 'project3');
    $kodeBanner = $_POST['kode_banner'];
    $namaBanner = $_POST['nama_banner'];
    $ext_file = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $nama_file_baru = 'image_banner_' . $kodeBanner . '.' . $ext_file;

    if (is_file('../img/banner_image/' . $nama_file_baru)) unlink('../img/banner_image/' . $nama_file_baru);

    $tmp_file = $_FILES['gambar']['tmp_name'];

    if ($ext_file == "jpg" || $ext_file == "jpeg" || $ext_file == "png") {

        $sql = "INSERT INTO banner (Kode_Banner, Nama_Banner, Gambar) 
    VALUES ('$kodeBanner', '$namaBanner','$nama_file_baru')";
        mysqli_query($koneksi, $sql);

        move_uploaded_file($tmp_file, '../img/banner_image/' . $nama_file_baru);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/input.css" rel="stylesheet" />
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        .bg-gradient-primary {
            background-color: #2ae19f;
            background-image: linear-gradient(180deg, #0e3617 10%, #22be4b 100%);
            background-size: cover;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img src="asset/logo.png" alt="" style="width: 20%" />
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">

                    <span>Tambah Toko</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="banner.php">

                    <span>Banner</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->

            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['admin_username'] ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End of Main Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <form action="banner.php" method="post" enctype="multipart/form-data">

                    <input type="text" name="kode_banner" required="" value="<?= idBannerGenerator() ?> " hidden>
                    <div class="question">
                        <input type="text" name="nama_banner" required="">
                        <label>Nama Banner</label>
                    </div>
                    <div class="question">
                        <input type="file" name="gambar" required="">
                    </div>
                    <div class="wrapper">
                        <button class="" type="submit" name="submit_insert">
                            <span>Submit</span>

                        </button>

                    </div>
                </form>
                <!-- =========================================== -->


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Banner</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="dataTable_length">
                                            <label>Tampilkan
                                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <label>Cari:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" /></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 68.6719px">
                                                        Kode_Banner
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 88.9062px">
                                                        Nama_Banner
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 56.25px">
                                                        Gambar
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Kode_Banner</th>
                                                    <th rowspan="1" colspan="1">Nama_Banner</th>

                                                    <th rowspan="1" colspan="1">Gambar</th>

                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $koneksi = mysqli_connect('localhost', 'root', '', 'project3');

                                                $sql = "SELECT * FROM banner";
                                                $result = mysqli_query($koneksi, $sql);

                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '
                            <tr>
                              <td>' . $row['Kode_Banner'] . '</td>
                              <td>' . $row['Nama_Banner'] . '</td>
                              <td>' . $row['Gambar'] . '</td>
                          
                            </tr>
                            ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                                </li>
                                                <li class="paginate_button page-item">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                                </li>

                                                <li class="paginate_button page-item next" id="dataTable_next">
                                                    <a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto"></div>
            </footer>
            <!-- End of Footer -->
        </div>

        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Anda Yakin Ingin Keluar?
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" untuk keluar dari halaman</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Batal
                    </button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>
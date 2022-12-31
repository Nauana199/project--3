<?php

require 'koneksi.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tabelt</title>
  <link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />
  <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />
  <link rel="canonical" href="https://codepen.io/coderob/pen/Mezawy" />

  <link rel="stylesheet" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css" />
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-6bce046e7128ddf9391ccf7acbecbf7ce0cbd7b6defbeb2e217a867f51485d25.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-550eae0ce567d3d9182e33cee4e187761056020161aa87e3ef74dc467972c555.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
  <script src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
  <script src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-90297fe4-edd5-973c-bf38-e17507177199" crossorigin=""></script>
</head>

<body>
  <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="example" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%">
      <thead>
        <tr role="row">
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 142px">
            Username
          </th>
          <th class="sorting_desc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 222px" aria-sort="descending">
            Total Pembayaran
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px">
            Tanggal Transaksi
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 47px">
            Kode Pembayaran
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 97px">
            Kode Voucher
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 80px">
            Kode Refund
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 80px">
            Kode Toko
          </th>
          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 80px">
            Pengambilan
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
          <td>Woo</td>
        </tr>
      </tbody>

      <tfoot>
        <tr>
          <th rowspan="1" colspan="1">Username</th>
          <th rowspan="1" colspan="1">Total Pembayaran</th>
          <th rowspan="1" colspan="1">Tangal Transaksi</th>
          <th rowspan="1" colspan="1">Kode Pembayaran</th>
          <th rowspan="1" colspan="1">Kode Voucher</th>
          <th rowspan="1" colspan="1">Kode Refund</th>
          <th rowspan="1" colspan="1">Kode Toko</th>
          <th rowspan="1" colspan="1">Pengambilan</th>
        </tr>
      </tfoot>
    </table>
    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
      <script src="main.js"></script>
    </div>
  </div>
</body>

</html>
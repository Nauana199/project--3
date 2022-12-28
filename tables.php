<?php
  // ambil data pendapatan dari database atau sumber data lainnya
  $data = array(
    array('Bulan', 'Pendapatan'),
    array('Januari', 1000),
    array('Februari', 1200),
    array('Maret', 1500),
    array('April', 222222222),
    array('Mei', 100)
  );
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chart Pendapatan</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
  <canvas id="chart"></canvas>
  <script type="text/javascript">
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php for($i = 1; $i < count($data); $i++) { echo '"' . $data[$i][0] . '",'; } ?>],
        datasets: [{
          label: 'Pendapatan',
          data: [<?php for($i = 1; $i < count($data); $i++) { echo $data[$i][1] . ','; } ?>],
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
</body>
</html>

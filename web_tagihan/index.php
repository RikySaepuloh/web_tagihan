<?php
require 'function/function.php';
require 'grafik/grafik.php';
session_start();
if (!isset($_SESSION["login"])) {
header("Location:login.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- DataTables JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript" charset="utf-8" async defer></script>
    <title>Dashboard | Admin</title>
    <style type="text/css">
    
    li a:active{
    color:white;
    }
    li a:hover{
    color:yellow;
    }
    li a{
    color: white;
    }
    
    </style>
    <script src="https://kit.fontawesome.com/6c071091af.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
  </head>
  <body style="background-color: #e9ecef;">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-2 px-1 bg-dark position-fixed" id="sticky-sidebar" style="height:100%;">
          <!-- <div class="justify-content-center ">
            <a class="nav-link active" style="color:white;" href="index.php">SAI</a>
          </div> -->
          <div class="row pt-5 pl-3">
            <ul class="nav flex-column" >
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="data-siswa.php">Data Siswa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="data-tagihan.php">Data Tagihan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="data-pembayaran.php">Data Pembayaran</a>
              </li>
              
            </ul>
          </div>
        </div>
        <div class="col offset-2" id="main">
          <div class="row bg-danger pt-2 justify-content-end" style="height:60px;">
            <!-- <nav class="nav align-middle" > -->
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="fas fa-power-off mr-2"></i>
                </a>
              </li>
            </ul>
            <!-- </nav> -->
          </div>
          <div class="row pl-2" >
            <div class="container bg-white rounded mt-4 pt-2 mr-2 pb-2">
              <div class="row">
                <div class="col-md-11">
                  <p><b>Dashboard</b></p>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="card text-center" style="color:white;background-color: #f8b703;">
                    <div class="card-body">
                      <h5 class="card-title">Siswa</h5>
                      <i class="fas fa-user-graduate fa-4x"></i><br><br>
                      <h4>
                      <?php jumlah_siswa(); ?>
                      </h4>
                    </div>
                    <a href="data-siswa.php" title="" >
                      <div class="card-footer text-muted" style="background-color: #e6b300">
                        <i class="fas fa-chevron-circle-right " style="color:white;">
                        Detail
                        </i>
                      </div>
                    </a>
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="card text-center" style="color:white;background-color: #6ebde4;">
                    <div class="card-body">
                      <h5 class="card-title">Tagihan</h5>
                      <i class="fas fa-book fa-4x"></i><br><br>
                      <h4>
                      <?php jumlah_tagihan() ?>
                      </h4>
                    </div>
                    <a href="data-tagihan.php" title="" style="color:white;">
                      <div class="card-footer text-muted" style="background-color:  #4ba4e8;">
                        <i class="fas fa-chevron-circle-right " style="color:white;">
                        Detail
                        </i>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card text-center" style="color:white;background-color: #f06560;">
                    <div class="card-body">
                      <h5 class="card-title">Pembayaran</h5>
                      <i class="fas fa-money-bill fa-4x"></i><br><br>
                      <h4>
                      <?php jumlah_pembayaran(); ?>
                      </h4>
                    </div>
                    <a href="data-pembayaran.php" title="" style="color:white;">
                      <div class="card-footer text-muted" style="background-color: #ed4336">
                        <i class="fas fa-chevron-circle-right " style="color:white;">
                        Detail
                        </i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                  <div id="grafik-batang" class="col-sm-6">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script>
    $(document).ready(function() {
    $('#table-dashboard').DataTable();
    } );
    </script>
    <script>
    
    Highcharts.chart('grafik-batang', {
      chart: {
      type: 'bar'
      },
      title: {
      text: 'Data Tagihan'
      },
      subtitle: {
      text: 'Jumlah Tagihan Terbanyak'
      },
      xAxis: {
      categories: ['Musab','Multi','Multia'],
      title: {
      text: null
      }
      },
      yAxis: {
      min: 0,
      title: {
      text: 'Tagihan',
      align: 'high'
      },
      labels: {
      overflow: 'justify'
      }
      },
      tooltip: {
      
      },
      plotOptions: {
      bar: {
      dataLabels: {
      enabled: true
      }
      }
      },
      legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -40,
      y: 80,
      floating: true,
      borderWidth: 1,
      backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
      shadow: true
      },
      credits: {
      enabled: false
      },
      series: [{
      name: 'Tagihan',
      data: [23,24,24],
      color: '#FFB41A'
      }]
    });
    
    </script>
  </body>
</html>
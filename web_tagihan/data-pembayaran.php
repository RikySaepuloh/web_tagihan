<?php
require 'function/function.php';
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
		table.table-number {
		counter-reset: rowNumber-2;
		}
		table.table-number tr {
		counter-increment: rowNumber;
		}
		table.table-number tr td:first-child::before {
		content: counter(rowNumber);
		min-width: 1em;
		margin-right: 0.5em;
		}
		</style>
		<script src="js/script-pembayaran.js"></script>
		<script src="https://kit.fontawesome.com/6c071091af.js"></script>
	</head>
	<body style="background-color: #e9ecef;">
		<!-- DATATABLE KETIKA DI APPEND MASIH BELUM BERFUNGSI DI BAGIAN SEARCH|SORT -->
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
					<div class="row pl-2">
						<!-- Tambah Data -->
						<div class="container rounded mt-4 pt-2 mr-2 pb-2" style="display: none;" id="container-tambah">
							<form  id="form-pembayaran" method="post" enctype="multipart/form-data">
								<div class="row justify-content-end bg-white pt-2 pb-2">
									<div class="col-md-1 ">
										<button type="button" class="btn badge badge-secondary btn_kembali" id="btn_kembali">Kembali</button>
									</div>
									<div class="col-md-1 ">
										<button type="submit" class="btn badge badge-success btn_save_tagihan">Save</button>
									</div>
								</div>
								<div class="row bg-white mt-2 pt-4 pb-2">
									<div class="col">
										<input type="hidden" name="no_bayar" id="no_bayar">
										<div class="form-group row">
											<label for="nim" class="col-sm-2 col-form-label">NIM</label>
											<div class="col-sm-10">
												<select name="nim" id="nim" class="form-control">
													<option value="" hidden selected>--- Pilih NIM ---</option>
													<?php
													opsi_siswa();
													?>
												</select>
												<!-- <input type="text" class="form-control" id="nim" name="nim" placeholder="nim"> -->
											</div>
										</div>
										<div class="form-group row">
											<label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
											<div class="col-sm-10">
												<input type="date" data-date-format="dd-mm-yyyy" class="form-control" id="tanggal" name="tanggal">
											</div>
										</div>
										<div class="form-group row">
											<label for="keterangan1" class="col-sm-2 col-form-label">Keterangan</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="keterangan1" id="keterangan1"></textarea>
											</div>
										</div>
										<!-- <button type="button" class="btn btn-primary mb-2 tambah-tagihan" data-toggle="modal" data-target="#modal-tambah-tagihan">Tambah Pembayaran</button> -->
									</div>
								</div>
								<div class="row bg-white mt-2 pt-4">
									<div class="col">
										<table class="table table-striped table-bordered" id="table-jenis-tagihan" style="width:100%;">
											<thead>
												<tr>
													<th>No Tagihan</th>
													<th>Keterangan</th>
													<th>Nilai Tagihan</th>
													<th>Nilai Bayar</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody id="table-tagihan">
												
												
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
						<!-- End of Tambah Data -->
						<!-- Lihat Data -->
						<div class="container rounded bg-white mt-4 pt-2 mr-2 pb-2"  id="container-data">
							<div class="row" >
								<div class="col-md-11">
									<p><b>Data Pembayaran</b></p>
								</div>
								<div class="col-md-1">
									<!-- Button tambah data -->
									<button type="button" class="btn badge badge-success btn_tbh_tagihan">Tambah</button>
								</div>
							</div>
							<div class="row" >
								<div class="col">
									<table id="table-dashboard" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th>No Pembayaran</th>
												<th>Tanggal</th>
												<th>NIM</th>
												<th>Keterangan</th>
												<th>Periode</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody id="display_area">
											<?php
													list_pembayaran();
											?>
											
										</tbody>
										<tfoot>
										<tr >
											<th>No Pembayaran</th>
											<th>Tanggal</th>
											<th>NIM</th>
											<th>Keterangan</th>
											<th>Periode</th>
											<th>Aksi</th>
										</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<!-- End of Lihat Data -->
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modal-tambah-bayar" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="formModalLabel">Tambah Data Tagihan</h5>
						<button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" id="form-modal-kode-bayar" enctype="multipart/form-data">
							<div class="form-group text-center">
								<input type="hidden" name="id" class="form-control" id="id" >
							</div>
							<div class="form-group">
								<label for="modal-tagihan">No Tagihan</label>
								<input type="text" class="form-control" name="modal-nota" id="modal-nota" readonly>
							</div>
							<div class="form-group">
								<label for="modal-keterangan">Keterangan</label>
								<input type="text" class="form-control" name="modal-keterangan" id="modal-keterangan" readonly>
							</div>
							<div class="form-group">
								<label for="modal-nt">Nilai Tagihan</label>
								<input type="text" class="form-control" name="modal-nt" id="modal-nt" readonly>
							</div>
							<div class="form-group">
								<label for="modal-nilai">Nilai</label>
								<input type="number" class="form-control" name="modal-nilai" min="0" id="modal-nilai">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary submit" id="submit_tagihan">Bayar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Modal -->
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<!-- DataTables JS -->
		
		<!-- <script>
		var myObj, i, x = "";
		myObj = {
		"name":"John",
		"age":30,
		"cars":[ "Ford", "BMW", "Fiat" ]
		};
		for (i = 0; i < myObj.cars.length; i++) {
		x += myObj.cars[i] + "<br>";
		}
		document.getElementById("demo").innerHTML = x;
		</script> -->
		
	</body>
</html>
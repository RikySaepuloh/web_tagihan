<?php 
	$arrayJur = array();

	$siswa = mysqli_query($conn, "SELECT ds.nama FROM dev_siswa ds INNER JOIN dev_tagihan_m dtm ON ds.nim=dtm.nim GROUP BY ds.nim ORDER BY count(dtm.nim) DESC LIMIT 4");
	$jumlah_tagihan = mysqli_query($conn, "SELECT count(dtm.nim) as jumlah_tagihan FROM dev_siswa ds INNER JOIN dev_tagihan_m dtm ON ds.nim=dtm.nim GROUP BY ds.nim ORDER BY count(dtm.nim) DESC LIMIT 4");
 ?>
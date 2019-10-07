$(document).ready(function() {
// DATA PEMBAYARAN
	var cota = document.getElementById("container-tambah");
    var coda = document.getElementById("container-data");
	$('#table-dashboard').DataTable();

	// Restrict negative number
	// Select your input element.
	var number = document.getElementById('modal-nilai');

	// Listen for input event on numInput.
	number.onkeydown = function(e) {
	    if(!((e.keyCode > 95 && e.keyCode < 106)
	      || (e.keyCode > 47 && e.keyCode < 58) 
	      || e.keyCode == 8)) {
	        return false;
	    }
	}

    // Button Kembali dari Tambah Tagihan
    $('.btn_kembali').on('click',function(){
        cota.style.display = "none";
        coda.style.display = "block";
    });

    $('#close-modal').on('click',function(){
    	$('#modal-kode').val('');
    	$('#modal-nilai').val('');
    	$('.input-row').removeClass('set-selected');
    });

    // Button Tambah Tagihan
    $('.btn_tbh_tagihan').on('click',function(){
        cota.style.display = "block";
        coda.style.display = "none";
        $('#no_tagihan').val('');
        $('#id').val('');
        $('#nim').val('');
        $('#keterangan').val('');
        $('#tanggal').val('');
    	$('#table-tagihan').html("");

    });	

    // Button Ubah Tagihan
	$(document).on('click','#btn_ubah_pembayaran',function(){
	    cota.style.display = "block";
        coda.style.display = "none";    

		$('#no_tagihan').val('');
		// $('#table-tagihan').empty();
        
        const no_bayar = $(this).data('id');
        var nim = $(this).closest('tr').find('td:eq(2)').text();
        var tanggal = $(this).closest('tr').find('td:eq(1)').text();
        var keterangan = $(this).closest('tr').find('td:eq(3)').text();

        $('#no_bayar').val(no_bayar);
        $('#nim').val(nim);
        // $('#id').val(no_tagihan);
        $('#tanggal').val(tanggal);
        $('#keterangan1').val(keterangan);

        $('#nim').val(nim);
        $.ajax({
        	url: 'function/proses-bayar.php',
        	type: 'POST',
        	data: {
        		'nim': nim
        	},
        	success: function(response){
        		$('#table-tagihan').html(response);
        	}
        });
    });        

	$('#container-tambah').on('submit','#form-pembayaran', function(e) {
        e.preventDefault();
        
        var angka = $('#no_bayar').val();
        var formdata = new FormData(this);

		if(angka!=''){
			// for(var pair of formdata.entries()) {
 		//   	console.log(pair[0]+ ', '+ pair[1]); 
			// }		
                $.ajax({
                    url: 'function/ubah-pembayaran.php',
                    contentType:false,
                    processData:false,
                    type:'POST',
                    data: formdata,
                    success: function(response){
                            $('#form-tagihan').modal('hide');
        					$('#display_area').html(response);
                            alert('Data Berhasil Diubah');
                        },
                    fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
                function display(response){

                    }
            }else{
            	    // alert('ini tambah');
                    $.ajax({
                        url: 'function/tambah-pembayaran.php',
                        type: 'POST',
                        contentType:false,
                        processData:false,
                        data:formdata,
                        success:function(response){
                            if (response=='date-failed') {
                                alert('Data Tanggal Belum Terisi !');
                            }else if(response=='nim-failed'){
                                alert('Data NIM Belum Terisi !');
                            }
                            else{
                                $('#form-pembayaran').modal('hide');
                                $('#display_area').html(response);
                                alert('Data Berhasil Ditambahkan');
                            }
                        },
                        fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
            }
        });

	$(document).on('click','.btn-hapus-pembayaran',function(){

        if(confirm("Yakin ingin menghapus data ?")){
        var no_bayar = $(this).data('id');
        // $clicked_btn = $(this);
        var tr = $(this).closest('tr');
        // , del_id = $(this).attr('id')
        $.ajax({
            url: 'function/delete-pembayaran.php',
            type: 'GET',
            data: {
                'delete-pembayaran' : 1,
                'no_bayar' : no_bayar,
            },
            success:function(data){
                tr.fadeOut(1000);
                // $('#display_area').html(data);
            }
        }); 
        }else{

        }  
    });

    $(document).on('change','#nim',function(){

    	var nim = $('#nim').val();
        $.ajax({
        	url: 'function/proses-bayar.php',
        	type: 'POST',
        	data: {
        		'nim': nim
        	},
        	success: function(response){
        		$('#table-tagihan').html(response);
        	}
        });
        
    });

    $(document).on('click','#btn_ubah_bayar',function(){
    	// const no_bayar = $(this).data('id');
    	var nota = $(this).closest('tr').find('td:eq(0)').text();
        var keterangan = $(this).closest('tr').find('td:eq(1)').text();
        var nita = $(this).closest('tr').find('td:eq(2)').text();
        var nilai = $(this).closest('tr').find('td:eq(3)').text();
        $(this).closest('tr').addClass('set-selected');

    	$('#modal-tambah-bayar').modal('show');
    	$('#modal-nota').val(nota);
        $('#modal-keterangan').val(keterangan);
        $('#modal-nt').val(nita);
        $('#modal-nilai').val(nilai);
    });

    $('#modal-tambah-bayar').on('submit','#form-modal-kode-bayar', function(e) {
        e.preventDefault();
        
        var formdata = new FormData(this);
		
                $.ajax({
                    url: 'function/ubah-tagih-bayar.php',
                    contentType:false,
                    processData:false,
                    type:'POST',
                    data: formdata,
                    success: function(response){
                            $('#form-tagihan').modal('hide');
        					$('.set-selected').closest('tr').html(response);
							$('.input-row').removeClass('set-selected');
                        },
                    fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
                function display(response){

                    }
        
        });

});	
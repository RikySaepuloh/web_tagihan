

$(document).ready(function() {

    $('#table-dashboard').DataTable();

    function fetch_data(){
        $.ajax({
               url: 'function.php',
               type: 'POST',
               data: {fetch: 1},
               success: function(data){
                $('#display_area').replaceWith(data);
                console.log(data);
               }
           });
    }

    // hilangkan tombol cari
    $('#tombol-cari').hide();
    
    // Modal Tambah
    $('.btnTambah').on('click',function(){
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        // $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#id').val('');
        $('#nim').val('');
        $('#nama').val('');
        $('#jurusan').val('');
        $('#submit_btn').show();
        $('#update_btn').hide();
    });

    // Modal Ubah
    $(document).on('click','.tampilModalUbah',function(){
    
        // $('.modal-footer button[type=submit]').html('Update');
        $('#formModalLabel').html('Ubah Data Mahasiswa');
        $('#nama').val('');
        $('#nim').val('');
        $('#jurusan').val('');
        $('#submit_btn').hide();
        $('#update_btn').show();

        const id = $(this).data('id');
        var nim = $(this).closest('tr').find('td:eq(0)').text();
        var nama = $(this).closest('tr').find('td:eq(1)').text();
        var jurusan = $(this).closest('tr').find('td:eq(2)').text();

        $('#id').val(id);
        $('#nim').val(nim);
        console.log(nim);
        $('#nama').val(nama);
        $('#jurusan').val(jurusan);
    
    });        

        $('.modal-content').on('submit','#form-siswa', function(e) {
        e.preventDefault();//kurang ini jadi kalo ga pake langsung reload lagi
        // //struktur nya kayak itu aja
        
        var angka = $('#id').val();
        var formdata = new FormData(this);

		if(angka!=''){
        	formdata.append('ubah',1);
                    console.log('Ubah data');
                $.ajax({
                    url: 'function/ubah-siswa.php',
                    contentType:false,
                    processData:false,
                    type:'POST',
                    data: formdata,
                    success: function(response){
                            $('#nim').val('');
                            $('#nama').val('');
                            $('#id').val('');
                            $('#jurusan').val('');
                            $('#formModal').modal('hide');
                            $('#display_area').html(response);
                            alert('Data berhasil diubah');
                        
                    },
                    fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
                function display(response){

                    }
            }else{
            	    formdata.append('tambah',1);
                    console.log('tambah data');
                    $.ajax({
                        url: 'function/function.php',
                        type: 'POST',
                        contentType:false,
                        processData:false,
                        data:formdata,
                        success:function(response){
                        if (response=='nim-failed') {
                        alert('Data NIM Belum Terisi!');
                        }else if(response=='nama-failed'){
                            alert('Data Nama Belum Terisi!');
                        }else if(response=='kode-failed'){
                            alert('Data Kode Jurusan Belum Terisi!');
                        }
                        else{
                            $('#id').val('');
                            $('#nim').val('');
                            $('#nama').val('');
                            $('#jurusan').val('');
                            $('#formModal').modal('hide');
                            $('#display_area').append(response);
                            alert('Data Berhasil Ditambahkan');
                        }
                        },
                        fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
            }
        });    
    
    

    

    $(document).on('click','.btnHapus',function(){

        if(confirm("Yakin ingin menghapus data ?")){
        var id = $(this).data('id');
        // $clicked_btn = $(this);
        var tr = $(this).closest('tr');
        // , del_id = $(this).attr('id')
        $.ajax({
            url: 'function/function.php',
            type: 'GET',
            data: {
                'delete' : 1,
                'id' : id,
            },
            success:function(data){
                $('#nrp').val('');
                $('#nama').val('');
                $('#email').val('');
                $('#jurusan').val('');
                tr.fadeOut(1000);
            }
        }); 
        }else{

        }  
    });

});

//gets rows of table
	    // var rowLength = oTable.rows.length;

	    // // buat json 
	    // var jsonObj = new Array();

	    // //loops through rows    
	    // // i = 1 agar tidak perlu mengambil table header
	    // if (rowLength>1) {
		   //  for (i = 1; i < rowLength; i++){
		   //    //gets cells of current row  
		   //     var oCells = oTable.rows.item(i).cells;

		   //     //gets amount of cells of current row
		   //     var cellLength = oCells.length;

		   //     //loops through each cell in current row
		   //     // cellLength - 1 agar tidak mengambil row aksi
		   //     // j = 1 agar tidak perlu mengambil nomor
		   //     for(var j = 1; j < cellLength-2; j++){
		   //     		if(j%2==0){
		   //     			continue;
		   //     		}else{
		   //     			jsonObj.push({"kode_jenis":oCells.item(j).innerHTML,"nilai":oCells.item(j+2).innerHTML});
		   //     		}
		   //      }
		   //  }
	    // }
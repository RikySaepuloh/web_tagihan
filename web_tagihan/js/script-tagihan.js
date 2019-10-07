$(document).ready(function() {
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

    var cota = document.getElementById("container-tambah");
    var coda = document.getElementById("container-data");

    //gets table
    var oTable = document.getElementById('table-jenis-tagihan');
    $('#table-tagihan').empty();

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

    // Button Kembali dari Tambah Tagihan
    $('.btn_kembali').on('click',function(){
        cota.style.display = "none";
        coda.style.display = "block";
    });

    $('#close-modal').on('click',function(){
        $('#modal-kode').val('');
        $('#modal-nilai').val('');
    });

    // Modal Tambah Tagihan
    $('.tambah-tagihan').on('click',function(){
        $('#id').val('');
        $('#modal-kode').val('');
        $('#modal-nilai').val('');
        $('#submit_tagihan').html('Tambah Data');

    });


//ADA DUA GET FROM TABLE | 1. UBAH | 2. INSERT


    //Button Hapus Tagihan
$(document).on('click','.btn-hapus-tagihan',function(){

        if(confirm("Yakin ingin menghapus data ?")){
        var no_tagihan = $(this).data('id');
        // $clicked_btn = $(this);
        var tr = $(this).closest('tr');
        // , del_id = $(this).attr('id')
        $.ajax({
            url: 'function/delete-tagihan.php',
            type: 'GET',
            data: {
                'delete-tagihan' : 1,
                'no_tagihan' : no_tagihan,
            },
            success:function(data){
       
                tr.fadeOut(1000);
                // $('#display_area').html(data);
            }
        }); 
        }else{

        }  
});


    
    // Button Ubah Tagihan
    $(document).on('click','#btn_ubah_tagihan',function(){
        cota.style.display = "block";
        coda.style.display = "none";    

        $('#no_tagihan').val('');
        $('#table-tagihan').empty();
        
        const no_tagihan = $(this).data('id');
        var nim = $(this).closest('tr').find('td:eq(1)').text();
        var tanggal = $(this).closest('tr').find('td:eq(2)').text();
        var keterangan = $(this).closest('tr').find('td:eq(3)').text();

        $('#no_tagihan').val(no_tagihan);
        $('#nim').val(nim);
        // $('#id').val(no_tagihan);
        $('#tanggal').val(tanggal);
        $('#keterangan').val(keterangan);


        $.ajax({
            url: 'function/no-ubah.php',
            type: 'POST',
            data: {
                'no-ubah': no_tagihan
            },
            success: function(response){
                $('#table-tagihan').append(response);
            }
        });

        
    
    });        

$('#modal-tambah-tagihan').on('submit','#form-modal-kode-tagihan', function(e) {
        e.preventDefault();
        

        var formdata = new FormData(this);

        if (formdata.get('id')=='') {
            var nota = $('#no_tagihan').val();
            formdata.append('no_tagihan',nota);
            // alert('ini tambah');
            $.ajax({
                url: 'function/tbh-kode-tagihan.php',
                contentType:false,
                processData:false,
                type:'POST',
                data: formdata,
                success: function(response){
                    if (response=='kode-failed') {
                        alert('Data Kode Jenis Belum Terisi!');
                    }else if(response=='nilai-failed'){
                        alert('Data Nilai Belum Terisi!');
                    }else{
                        $('#form-modal-kode-tagihan').modal('hide');
                        $('#table-tagihan').append(response);
                    }
                },
                fail: function(xhr, textStatus, errorThrown){
                    alert('request failed:'+textStatus);
                }
            });
                function display(response){
            }
        }else{
            var nota = $('#no_tagihan').val();
            formdata.append('no_tagihan',nota);
            // alert('ini ubah');
            $.ajax({
                url: 'function/ubh-kode-tagihan.php',
                contentType:false,
                processData:false,
                type:'POST',
                data: formdata,
                success: function(response){
                $('#form-modal-kode-tagihan').modal('hide');
                $('.set-selected').closest('tr').html(response);
                $('.input-row').removeClass('set-selected');
                },
                fail: function(xhr, textStatus, errorThrown){
                    alert('request failed:'+textStatus);
                }
            });
        }
});  
        


$('#container-tambah').on('submit','#form-tagihan', function(e) {
        e.preventDefault();
        
        var angka = $('#no_tagihan').val();
        var formdata = new FormData(this);

        // un-comment 3 baris dibawah ini untuk melihat entry formdata
  //       for(var pair of formdata.entries()) {
    //          console.log(pair[0]+ ', '+ pair[1]); 
        // }    
     
        if(angka!=''){
            formdata.append('ubah-tagihan',1);

                $.ajax({
                    url: 'function/ubah-tagihan.php',
                    contentType:false,
                    processData:false,
                    type:'POST',
                    data: formdata,
                    success: function(response){
                            $('#form-tagihan').modal('hide');
                            alert('Data Berhasil Diubah');
                            $('#display_area').html(response);
                        },
                    fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
                function display(response){

                    }
            }else{
                    formdata.append('tambah-tagihan',1);
                    $.ajax({
                        url: 'function/tambah-tagihan.php',
                        type: 'POST',
                        contentType:false,
                        processData:false,
                        data:formdata,
                        success:function(response){
                            if (response=='nim-failed') {
                                alert('Data NIM Belum Terisi!');
                            }else if(response=='date-failed'){
                                alert('Data Tanggal Belum Terisi!');
                            }else{
                                $('#form-tagihan').modal('hide');
                                $('#display_area').html(response);
                                $('#nim').val('');
                                $('#tanggal').val('');
                                $('#keterangan').val('');
                                $('#table-tagihan').html('');
                                alert('Data Berhasil Ditambahkan');
                            }
                        },
                        fail: function(xhr, textStatus, errorThrown){
                            alert('request failed:'+textStatus);
                        }
                    });
            }
    });    

$(document).on('click','.btn_hapus_trans',function(){

        if(confirm("Yakin ingin menghapus data ?")){
        var no_bayar = $(this).data('id');
        // $clicked_btn = $(this);
        var tr = $(this).closest('tr');
        // , del_id = $(this).attr('id')
        tr.remove();
        }  
    });

$(document).on('click','#btn_ubah_trans',function(){
        
        const no_tagihan = $(this).data('id');
        var kode_jenis = $(this).closest('tr').find('td:eq(1)').text();
        var nilai = $(this).closest('tr').find('td:eq(3)').text();
        $(this).closest('tr').addClass('set-selected');

        $('#modal-tambah-tagihan').modal('show');
        $('#id').val('ubah');
        $('#modal-kode').val(kode_jenis);
        $('#modal-nilai').val(nilai);
        $('#submit_tagihan').html('Ubah Data');

    });
});
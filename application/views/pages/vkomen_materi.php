<div class="content-wrapper" style="min-height: 1126px;">

	<div class="modal fade" id="modal-default" style="display: none;">
		<div class="modal-dialog">
			<div id="id_MdlDefault" class="modal-content">

			<!-- isi modal dinamis disini -->
			</div>

		<!-- /.modal-content -->
		</div>
	<!-- /.modal-dialog -->
	</div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <h1>
        <?php echo $title ?>
      </h1>
       <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i>MENU KELOLA</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
          <a  id="id_BtnAddKomen_materi" class="btn btn-primary">Tambah Komentar</a>

        </div>

        <div class="box-body">
         <div id="id_DivKomen_materi">
            	<!-- data user akan tampil disini -->
         </div>
        </div>
        <!-- /.box-body -->
          </div>

      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>

<script>
	// ketika DOM ready
	$(document).ready(function(){
		GenDatakomen_materi();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddKomen_materi', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/addkomen_materi",
            success: function(res) {


                $('#id_MdlDefault').html(res);
								// rubah editor
								CKEDITOR.replace( 'id_konten' );
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
								form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddKomen_materi').validate({
												 rules:{
											//			 id_ppnnik: {
											//					required: true,
											//					maxlength: 5
											//			 },
														 id_namakomen_materi: {
			 															required: true,
			 															maxlength: 5
			 													 }
												 },
												 messages: {
														 id_namakomen_materi: "isi nama komen_materi dengan benar"
												}
										 });
								 });
								 Date picker
								 $('#id_tposting').datepicker({
								 		autoclose: true
								 });
        SaveKomen_materi();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatakomen_materi(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/showkomen_materi",
            success: function(res) {
                $('#id_DivKomen_materi').html(res);
				$(function() {
					$('#example1').DataTable({
            'retrieve'    : true,
						'paging'      : true,
						'lengthChange': false,
						'searching'   : true,
						'ordering'    : true,
						'info'        : true,
						'autoWidth'   : true
					})
				})
            },
            error: function(xhr){
               $('#id_DivKomen_materi').html("error");
            }
        });
	}



  // save user
  function SaveKomen_materi(){
		$(document).off('click','#id_komen_materibtn');
    $(document).on('click', '#id_komen_materibtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddKomen_materi').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/savekomen_materi",
        data: {

					id_login: $('#id_login').val(),
					id_materi: $('#id_materi').val(),
				 	id_konten: $('#id_konten').val(),
          id_tposting: $('#id_tposting').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatakomen_materi();
        },
            error: function(xhr){
               $('#id_DivKomen_materi').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }


//Saat tombol Hapus di klik
  function Delkomen_materi(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/delkomen_materi",
        data: {
          id_list_komen_materi: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatakomen_materi();
        },
        error: function(xhr){
           $('#id_DivKomen_materi').html("error");
        }
      });
    }
  }

	//Saat Tombol Edit di Klik
	function UploadKomen_materi(Komen_materi_id){
	    $('#modal-default').modal('show');
	    jQuery.ajax({
	        type: "POST",
	        url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/showupload",
	        data: {
	            komen_materi_id: komen_materi_id
	        },
	        success: function(res) {
	            $('#id_MdlDefault').html(res);
	            UploadPDF(komen_materi_id);
	        },
	        error: function(xhr){
	            $('#id_DivKomen_materi').html("error");
	        }
	    });
	}

	function UploadPDF(komen_materi_id){
	    event.preventDefault();
	    $('#upload').on('click', function () {
	        var file_data = $('#file').prop('files')[0];
	        var form_data = new FormData();
	        form_data.append('file', file_data);
	        $.ajax({
	            url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/upload_file/"+komen_materi_id,
	            dataType: 'text',
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: form_data,
	            type: 'post',
	            beforeSend: function(){
	                $('.modal-body').html("Tunggu, lagi upload nih...!");
	            },
	            success: function (response) {
								$('#modal-default').modal('hide');
	                $('.modal-body').html(response);
	                GenDatakomen_materi();
	            },
	            error: function (response) {
	                $('.modal-body').html(response);
	            }
	        });
	    });
	}

</script>

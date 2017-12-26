
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

        <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pengumuman</h3>
             <!-- <button type="button" id="id_BtnAddPengumuman" class="btn btn-primary btn-sm pull-right">Tambah Pengumuman	</button> -->
        </div>
        <div class="box-body">
         <div id="id_DivPengumuman">
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
		GenDatapengumuman();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddPengumuman', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/addpengumuman",
            success: function(res) {
                $('#id_MdlDefault').html(res);
								// rubah editor
								CKEDITOR.replace( 'id_konten' );

								$('#id_ttutup, #id_ttampil').datepicker({
			              autoclose: true
			          });
								// form validation on ready state
                 $().ready(function(){
                     $('#id_FrmAddPengumuman').validate({
                         rules:{
                             id_judul: "required",
														 id_konten: "required",
														 id_ttampil: "required",
														 id_ttutup: "required"
                         },
                         messages: {
                             id_judul: "isi Judul Pengumuman dengan benar",
														 id_konten: "isi Konten dengan benar",
														 id_ttutup: "isi Tanggal Tutup dengan benar",
														 id_ttampil: "isi Tanggal tampil dengan benar"
                        }
                     });
                 });
								 id_ttampil: "isi Tanggal Tampil dengan benar",

                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
        SavePengumuman();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })




	// function untuk populate data user dari table database
	function GenDatapengumuman(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdetailpengumuman/showdetailpengumuman",
            success: function(res) {
                $('#id_DivPengumuman').html(res);
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
               $('#id_DivPengumuman').html("error");
            }
        });
	}

  // save user
  function SavePengumuman(){
		$(document).off('click','#id_pengumumanbtn');
    $(document).on('click', '#id_pengumumanbtn', function(e){
			e.preventDefault();

			$ttampil = $('#id_ttampil').val();
			$ttutup   = $('#id_ttutup').val();

			if ($ttampil < $ttutup) {
				console.log("true");

      if($('#id_FrmAddPengumuman').valid()){
	      jQuery.ajax({
	        type: "POST",
	        url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/savepengumuman",
	        data: {
	           id_judul: $('#id_judul').val(),
						 id_konten: CKEDITOR.instances.id_konten.getData(),
						 id_ttampil: $('#id_ttampil').val(),
						 id_ttutup: $('#id_ttutup').val()
	        },
	              success: function(res) {
	         $('#modal-default').modal('hide');
	          alert("Data saved!" + res);
	          GenDatapengumuman();
	        },
	            error: function(xhr){
	               $('#id_DivPengumuman').html("error");
	            }
	        });
			} else {
				// dan jika gagal
				 return false;
				}

			} else {
				alert("Tanggal yang anda masukan tidak sesuai !!! !");
			}

    })
  }

	//Saat Tombol upload di Klik
	function UploadPengumuman(pengumuman_id){
			$('#modal-default').modal('show');
			jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/showupload",
					data: {
							pengumuman_id: pengumuman_id
					},
					success: function(res) {
							$('#id_MdlDefault').html(res);
							UploadPDF(pengumuman_id);
					},
					error: function(xhr){
							$('#id_DivPengumuman').html("error");
					}
			});
	}

	function UploadPDF(pengumuman_id){
			event.preventDefault();
			$('#upload').on('click', function () {
					var file_data = $('#file').prop('files')[0];
					var form_data = new FormData();
					form_data.append('file', file_data);
					$.ajax({
							url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/upload_file/"+pengumuman_id,
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
									GenDatapengumuman();
							},
							error: function (response) {
									$('.modal-body').html(response);
							}
					});
			});
	}

  //Saat Tombol Edit di Klik
  function EditPengumuman(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/showeditpengumuman",
        data: {
					id : id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_ttutup, #id_ttampil').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivPengumuman').html("error");
        }
      });
  }

	function DetailPengumuman(id){
		$.redirectPost("<?php echo base_url(); ?>" + "index.php/cdetailpengumuman/showdetailpengumuman",{id_list_pengumuman: id});
	}

  //Saat tombol save change di klik
  function Updpengumuman($id){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/Editpengumuman",
      data: {
         id_peng: $id,
         id_judul: $('#id_judul').val(),
				 id_konten2: CKEDITOR.instances.id_konten2.getData(),
         id_ttampil: $('#id_ttampil').val(),
				 id_ttutup: $('#id_ttutup').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatapengumuman();
      },
      error: function(xhr){
         $('#id_DivPengumuman').html("error");
      }
    });
  }

  function DelPengumuman(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudpengumuman/delpengumuman",
        data: {
          id_list_pengumuman: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatapengumuman();
        },
        error: function(xhr){
           $('#id_DivPengumuman').html("error");
        }
      });
    }
  }

</script>

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
          <a  id="id_BtnAddMateri" class="btn btn-primary">Tambah Materi</a>

        </div>

        <div class="box-body">
         <div id="id_DivMateri">
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
		GenDatamateri();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddMateri', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/addmateri",
            success: function(res) {


                $('#id_MdlDefault').html(res);
								// rubah editor
								CKEDITOR.replace( 'id_konten' );
                //Date picker
                // $('#id_tam').datepicker({
                //     autoclose: true
                // });
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddMateri').validate({
												 rules:{
											//			 id_ppnnik: {
											//					required: true,
											//					maxlength: 5
											//			 },
														 id_namamateri: {
			 															required: true,
			 															maxlength: 5
			 													 }
												 },
												 messages: {
														 id_namamateri: "isi nama materi dengan benar"
												}
										 });
								 });
								 //Date picker
								 // $('#id_tposting').datepicker({
								 // 		autoclose: true
								 // });
        SaveMateri();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatamateri(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/showmateri",
            success: function(res) {
                $('#id_DivMateri').html(res);
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
               $('#id_DivMateri').html("error");
            }
        });
	}

  // save user
  function SaveMateri(){
		$(document).off('click','#id_materibtn');
    $(document).on('click', '#id_materibtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddMateri').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/savemateri",
        data: {
					id_judul: $('#id_judul').val(),
				 	id_konten: CKEDITOR.instances.id_konten.getData(),
          id_file: $('#id_file').val(),
          id_tposting: $('#id_tposting').val(),
					id_mapel: $('#id_mapel').val(),
          id_pengajar: $('#id_pengajar').val(),
        	id_kelas: $('#id_kelas').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatamateri();
        },
            error: function(xhr){
               $('#id_DivMateri').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }

	function DetailMateri(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/showdetailmateri",
				data: {
					id_list_materi: id
				},
				success: function(res) {
					$('#id_MdlDefault').html(res);
					//Date picker
					$('#id_tm').datepicker({
							autoclose: true
					});
					$('#id_judul').attr('readonly', true);
					$('#id_konten2').attr('readonly', true);
					$('#id_ttampil').attr('readonly', true);
					$('#id_ttutup').attr('readonly', true);
					$('input[name="radio1"]').attr('disabled', 'disabled');
					$('input[name="radio2"]').attr('disabled', 'disabled');
				},
				error: function(xhr){
					 $('#id_DivMateri').html("error");
				}
			});
	}
  //Saat Tombol Edit di Klik
  function EditMateri(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/showeditmateri",
        data: {
          id_list_materi: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivMateri').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updmateri(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/Editmateri",
      data: {
				id_materi_id: $('#id_materi_id').val(),
				id_judul: $('#id_judul').val(),
				id_konten2: CKEDITOR.instances.id_konten2.getData(),
				id_file: $('#id_file').val(),
				id_tposting: $('#id_tposting').val(),
				id_mapel: $('#id_mapel').val(),
				id_pengajar: $('#id_pengajar').val(),
				id_kelas: $('#id_kelas').val()
			},

      success: function(res) {
        $('#modal-default').modal('hide');
        alert(res);
        GenDatamateri();
      },
      error: function(xhr){
         $('#id_DivMateri').html("error");
      }
    });
  }

//Saat tombol Hapus di klik
  function Delmateri(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/delmateri",
        data: {
          id_list_materi: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatamateri();
        },
        error: function(xhr){
           $('#id_DivMateri').html("error");
        }
      });
    }
  }

	//Saat Tombol Edit di Klik
	function UploadMateri(materi_id){
	    $('#modal-default').modal('show');
	    jQuery.ajax({
	        type: "POST",
	        url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/showupload",
	        data: {
	            materi_id: materi_id
	        },
	        success: function(res) {
	            $('#id_MdlDefault').html(res);
	            UploadPDF(materi_id);
	        },
	        error: function(xhr){
	            $('#id_DivMateri').html("error");
	        }
	    });
	}

	function UploadPDF(materi_id){
	    event.preventDefault();
	    $('#upload').on('click', function () {
	        var file_data = $('#file').prop('files')[0];
	        var form_data = new FormData();
	        form_data.append('file', file_data);
	        $.ajax({
	            url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/upload_file/"+materi_id,
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
	                GenDatamateri();
	            },
	            error: function (response) {
	                $('.modal-body').html(response);
	            }
	        });
	    });
	}

	function MateriKomentar(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/showmaterikomentar",
				data: {
					id_list_materi: id
				},
				success: function(res) {
					$('#id_MdlDefault').html(res);

					// rubah editor
					CKEDITOR.replace( 'id_konten' );
					//Date picker
					$('#id_tposting').datepicker({
							autoclose: true
					});

					$().ready(function(){
							$('#id_FrmAddJawaban').validate({
									rules:{
									 id_materi_id: "required",
									 id_konten: "required",
									 id_login: "required"

									},
									messages: {
											id_materi_id: "Login id tidak boleh kosong",
											id_login: "Login id tidak boleh kosong",
											id_konten: "konten tidak boleh kosong"
								 }
							});
					});
					$('#id_tbuat').datepicker({
						 autoclose: true
					});
					Savekomentar();
				},
				error: function(xhr){
					 $('#id_MdlDefault').html("error");
				}
			});
	}

	// save user
	function Savekomentar(){
		$(document).off('click','#id_Btnkomentar');
		$(document).on('click', '#id_Btnkomentar', function(e){
			// falidasi
			e.preventDefault();

			// $materi_id = $('#id_materi_id').val();
			// $tposting = $('#id_tposting').val();
			// $login = $('#id_login').val();
			// $konten = $('#id_konten').val();
      //
			// if ($materi_id=not null) {
			// 	console.log("true");

			if($('#id_FrmAddJawaban').valid()){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/savekomentar",
				data: {
					id_materi_id: $('#id_materi_id').val(),
					id_tposting: $('#id_tposting').val(),
					id_login: $('#id_login').val(),
					id_konten: CKEDITOR.instances.id_konten.getData()
				},
				success: function(res) {
					$('#modal-default').modal('hide');
					alert("Data saved!" + res);
					GenDatamateri();
				},
				error: function(xhr){
					 $('#id_DivMateri').html("error");
						}
				});
					} else {
				// dan jika gagal
					 return false;
					}

				// } else {
				// 	alert("Tanggal yang anda masukan tidak sesuai !!! !");
				// }

		})
	}

	//Saat tombol Hapus di klik
	  function DelKomentar(id){
	    var delconf = confirm("Hapus data?");
	    if(delconf){
	      jQuery.ajax({
	        type: "POST",
	        url: "<?php echo base_url(); ?>" + "index.php/ccrudmateri/delkomentar",
	        data: {
	          id_list_komentar: id
	        },
	        success: function(res) {
	          $('#modal-default').modal('hide');
	          alert("Data Terhapus!");
	          GenDatamateri();
	        },
	        error: function(xhr){
	           $('#id_DivKomentar').html("error");
	        }
	      });
	    }
	  }

</script>

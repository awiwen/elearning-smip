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
        Komentar Materi
      </h1>
       <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
        <li class="active">Komentar Materi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
             <button type="button" id="id_BtnAddKomen_materi" class="btn btn-primary">Tambah Komentar</button>
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

// ketika tombol komentar user di klik
	$(document).on('click', '#id_BtnAddKomen_materi', function(){
	// tampilkan modal
	$('#modal-default').modal('show');
	// isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/addkomen_materi",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });

								$(function(){
									$('#id_jmulai').clockface();
									$('#id_jselesai').clockface();
								});

									// $("#id_jmulai").on("dp.change", function (e) {
									// $('#id_jselesai').data("clockface").minClockface(e.clockface);
									// });
									// $("#id_jmulai").on("dp.change", function (e) {
									// $('#id_jselesai').data("clockface").maxClockface(e.clockface);
									// });

								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddKomen_materi').validate({
												 rules:{
													//  id_is: {
		 											// 	 required: true,
		 											// 	 maxlength: 10
		 											// },
													// id_tm: {
													// 	required: true,
													// 	maxlength: 4,
													// 	minlength: 4,
												 // },
		 											id_hari: "required",
													id_mapel_kelas: "required",
													id_pengajar: "required",
													id_jmulai: "required",
													id_jselesai: "required"
		 									},
		 									messages: {
		 											id_hari: "hari tidak boleh kosong",
													id_mapel_kelas: "matapelajaran tidak boleh kosong",
													id_pengajar: "pengajar tidak boleh kosong",
													id_jmulai: "jam mulai tidak boleh kosong",
													id_jselesai: "jam selesai tidak boleh kosong"
												}
										 });
								 });

        Savekomen_materi();
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
	function Savekomen_materi(){
		$(document).off('click','#id_komen_materibtn');
		$(document).on('click', '#id_komen_materibtn', function(e){

			// falidasi
			e.preventDefault();
							if($('#id_FrmAddKomen_materi').valid()){

			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/savekomen_materi",
				data: {
					 id_hari: $('#id_hari').val(),
					 id_mapel_kelas: $('#id_mapel_kelas').val(),
					 id_pengajar: $('#id_pengajar').val(),
					 id_jmulai: $('#id_jmulai').val(),
					 id_jselesai: $('#id_jselesai').val()
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

	//Saat Tombol Edit di Klik
	function EditKomen_materi(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/showeditkomen_materi",
				data: {
					id_list_mapel_ajar: id
				},
				success: function(res) {
					$('#id_MdlDefault').html(res);
					//Date picker
					$('#id_tam').datepicker({
							autoclose: true
					});

					$(function(){
						$('#id_jmulai').clockface();
					});

					$(function(){
						$('#id_jselesai').clockface();
					});

				},
				error: function(xhr){
					 $('#id_DivKomen_materi').html("error");
				}
			});
	}

  //Saat tombol save change di klik
  function UpdKomen_materi(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/editkomen_materi",
      data: {
         id_mapel_ajar: $('#id_mapel_ajar').val(),
         id_hari: $('#id_hari').val(),
         id_mapel_kelas: $('#id_mapel_kelas').val(),
         id_pengajar: $('#id_pengajar').val(),
         id_jmulai: $('#id_jmulai').val(),
         id_jselesai: $('#id_jselesai').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatakomen_materi();
      },
      error: function(xhr){
         $('#id_DivKomen_materi').html("error");
      }
    });
  }

  function DelKomen_materi(id){
		console.log(id);
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkomen_materi/Delkomen_materi",
        data: {
          id_list_mapel_ajar: id
        },
        success: function(res) {
					console.log(res);
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



</script>

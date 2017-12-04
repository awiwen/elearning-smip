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
        Beranda
      </h1>
       <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
             <button type="button" id="id_BtnAddDashboard" class="btn btn-primary">Tambah Jadwal</button>
				</div>
        <div class="box-body">
         <div id="id_DivDashboard">
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
		GenDatadashboard();
	});

// ketika tombol tambah user di klik
	$(document).on('click', '#id_BtnAddDashboard', function(){
	// tampilkan modal
	$('#modal-default').modal('show');
	// isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/adddashboard",
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

								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddDashboard').validate({
												 rules:{
													 id_is: {
		 												 required: true,
		 												 maxlength: 10
		 											},
													id_tm: {
														required: true,
														maxlength: 4,
														minlength: 4,
												 },
		 											id_nama: "required",
													id_tel: "required",
													id_tam: "required",
													id_alamat: "required"
		 									},
		 									messages: {
		 											id_is: "isi NIS dengan benar",
													id_nama: "isi Nama dengan benar",
													id_tel: "isi Tempat Lahir dengan benar",
													id_tam: "isi tanggal lahir dengan benar",
													id_alamat: "isi alamat dengan benar",
		 											id_tm: "isi tahun masuk dengan benar"
												}
										 });
								 });

        Savedashboard();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatadashboard(){
		jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/showdashboard",
        success: function(res) {
            $('#id_DivDashboard').html(res);
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
           $('#id_DivDashboard').html("error");
        }
    });
	}

	// save user
	function Savedashboard(){
		$(document).off('click','#id_dashboardbtn');
		$(document).on('click', '#id_dashboardbtn', function(e){

			// falidasi
			e.preventDefault();
							if($('#id_FrmAddDashboard').valid()){

			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/savedashboard",
				data: {
					 id_hari: $('#id_hari').val(),
					 id_kelas: $('#id_kelas').val(),
					 id_mapel: $('#id_mapel').val(),
					 id_pengajar: $('#id_pengajar').val(),
					 id_jmulai: $('#id_jmulai').val(),
					 id_jselesai: $('#id_jselesai').val()
				},
							success: function(res) {
				 $('#modal-default').modal('hide');
					alert("Data saved!" + res);
					GenDatadashboard();
				},
						error: function(xhr){
							 $('#id_DivDashboard').html("error");
						}
				});

			} else {
		// dan jika gagal
			 return false;
			}

		})
	}

  //Saat Tombol Edit di Klik
  function EditDashboard(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/showeditdashboard",
        data: {
          id_list_dashboard: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivDashboard').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function UpdDashboard(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/Editdashboard",
      data: {
         id_dashboard: $('#id_s').val(),
         id_is: $('#id_is').val(),
         id_nama: $('#id_nama').val(),
         id_jk: $('#id_jk').val(),
         id_tel: $('#id_tel').val(),
         id_tam: $('#id_tam').val(),
				 id_agama: $('#id_agama').val(),
         id_alamat: $('#id_alamat').val(),
				 id_tm: $('#id_tm').val(),
         id_status: $('#id_status').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatadashboard();
      },
      error: function(xhr){
         $('#id_DivDashboard').html("error");
      }
    });
  }

  function DelDashboard(id){
		console.log(id);
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard/Deldashboard",
        data: {
          id_list_dashboard: id
        },
        success: function(res) {
					console.log(res);
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
					GenDatadashboard();
        },
        error: function(xhr){
           $('#id_DivDashboard').html("error");
        }
      });
    }
  }



</script>

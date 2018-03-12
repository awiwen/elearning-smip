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

        <!-- <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li> -->
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
				<!-- <div class="box">
	        <div class="box-header with-border"> -->


      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
					<script>
				 function redirect(url){
					 location.href = url;
				 }
				 </script>
				 <button onclick="redirect('http://localhost/elearning-smip/index.php/ccaridashboard_s/showcaridashboard/')"
					 type="button" class="btn btn-primary"><i class="fa fa-fw"></i>cari</button>
				</div>
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
            url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/adddashboard",
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

								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddDashboard').validate({
												 rules:{

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
        url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/showdashboard",
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

			$jmulai = $('#id_jmulai').val();
			$jselesai = $('#id_jselesai').val();

			if ($jmulai < $jselesai) {
				console.log("true");

			if($('#id_FrmAddDashboard').valid()){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/savedashboard",
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

		} else {
			alert("Jam yang anda masukan tidak sesuai !!! !");
		}

		})
	}

	//Saat Tombol Edit di Klik
	function EditDashboard(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/showeditdashboard",
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
					 $('#id_DivDashboard').html("error");
				}
			});
	}

  //Saat tombol save change di klik
  function UpdDashboard(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/editdashboard",
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
        url: "<?php echo base_url(); ?>" + "index.php/ccruddashboard_s/Deldashboard",
        data: {
          id_list_mapel_ajar: id
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

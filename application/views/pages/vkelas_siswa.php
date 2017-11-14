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
          <a  id="id_BtnAddKelas_siswa" class="btn btn-primary">Tambah Siswa</a>

        </div>

        <div class="box-body">
         <div id="id_DivKelas_siswa">
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
		GenDatakelas_siswa();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddKelas_siswa', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/addkelas_siswa",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddKelas_siswa').validate({
												 rules:{
											//			 id_ppnnik: {
											//					required: true,
											//					maxlength: 5
											//			 },
														 id_namakelas_siswa: {
			 															required: true,
			 															maxlength: 5
			 													 }
												 },
												 messages: {
														 id_namakelas_siswa: "isi nama kelas_siswa dengan benar"
												}
										 });
								 });

        SaveKelas_siswa();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatakelas_siswa(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/showkelas_siswa",
            success: function(res) {
                $('#id_DivKelas_siswa').html(res);
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
               $('#id_DivKelas_siswa').html("error");
            }
        });
	}

  // save user
  function SaveKelas_siswa(){
		$(document).off('click','#id_kelas_siswabtn');
    $(document).on('click', '#id_kelas_siswabtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddKelas_siswa').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/savekelas_siswa",
        data: {

           id_kelas: $('#id_kelas').val(),
					 id_siswa: $('#id_siswa').val()

        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatakelas_siswa();
        },
            error: function(xhr){
               $('#id_DivKelas_siswa').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }


  //Saat Tombol Edit di Klik
  function EditKelas_siswa(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/showeditkelas_siswa",
        data: {
          id_list_kelas_siswa: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivKelas_siswa').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updkelas_siswa(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/Editkelas_siswa",
      data: {
				 id_kelassiswa: $('#id_kelassiswa').val(),
         id_kelas: $('#id_kelas').val(),
         id_siswa: $('#id_siswa').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatakelas_siswa();
      },
      error: function(xhr){
         $('#id_DivKelas_siswa').html("error");
      }
    });
  }

  function DelKelas_siswa(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas_siswa/delkelas_siswa",
        data: {
          id_list_kelas_siswa: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatakelas_siswa();
        },
        error: function(xhr){
           $('#id_DivKelas_siswa').html("error");
        }
      });
    }
  }

</script>

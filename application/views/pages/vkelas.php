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
          <a  id="id_BtnAddKelas" class="btn btn-primary">Tambah Kelas</a>

        </div>

        <div class="box-body">
         <div id="id_DivKelas">
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
		GenDatakelas();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddKelas', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/addkelas",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddKelas').validate({
												 rules:{
											//			 id_ppnnik: {
											//					required: true,
											//					maxlength: 5
											//			 },
														 id_namakelas: {
			 															required: true,
			 															maxlength: 5
			 													 }
												 },
												 messages: {
														 id_namakelas: "isi nama kelas dengan benar"
												}
										 });
								 });

        SaveKelas();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatakelas(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/showkelas",
            success: function(res) {
                $('#id_DivKelas').html(res);
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
               $('#id_DivKelas').html("error");
            }
        });
	}



  // save user
  function SaveKelas(){
		$(document).off('click','#id_kelasbtn');
    $(document).on('click', '#id_kelasbtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddKelas').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/savekelas",
        data: {

           id_namakelas: $('#id_namakelas').val(),
           id_parent: $('#id_parent').val(),
           id_status: $('#id_status').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatakelas();
        },
            error: function(xhr){
               $('#id_DivKelas').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }


  //Saat Tombol Edit di Klik
  function EditKelas(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/showeditkelas",
        data: {
          id_list_kelas: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivKelas').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updkelas(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/EditKelas",
      data: {
         id_kelas: $('#id_kelas').val(),

         id_namakelas: $('#id_namakelas').val(),
         id_parent: $('#id_parent').val(),

         id_status: $('#id_status').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatakelas();
      },
      error: function(xhr){
         $('#id_DivKelas').html("error");
      }
    });
  }

  function Delkelas(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/delkelas",
        data: {
          id_list_kelas: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatakelas();
        },
        error: function(xhr){
           $('#id_DivKelas').html("error");
        }
      });
    }
  }

</script>

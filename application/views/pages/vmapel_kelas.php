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
          <a  id="id_BtnAddMapel_kelas" class="btn btn-primary">Tambah mapel_kelas</a>

        </div>

        <div class="box-body">
         <div id="id_DivMapel_kelas">
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
		GenDatamapel_kelas();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddMapel_kelas', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/addmapel_kelas",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddMapel_kelas').validate({
												 rules:{
											//			 id_ppnnik: {
											//					required: true,
											//					maxlength: 5
											//			 },
														 id_namamapel_kelas: {
			 															required: true,
			 															maxlength: 5
			 													 }
												 },
												 messages: {
														 id_namamapel_kelas: "isi nama mapel_kelas dengan benar"
												}
										 });
								 });

        SaveMapel_kelas();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatamapel_kelas(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/showmapel_kelas",
            success: function(res) {
                $('#id_DivMapel_kelas').html(res);
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
               $('#id_DivMapel_kelas').html("error");
            }
        });
	}



  // save user
  function SaveMapel_kelas(){
		$(document).off('click','#id_mapel_kelasbtn');
    $(document).on('click', '#id_mapel_kelasbtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddMapel_kelas').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/savemapel_kelas",
        data: {

           id_namamapel_kelas: $('#id_namamapel_kelas').val(),
           id_parent: $('#id_parent').val(),
           id_status: $('#id_status').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatamapel_kelas();
        },
            error: function(xhr){
               $('#id_DivMapel_kelas').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }


  //Saat Tombol Edit di Klik
  function EditMapel_kelas(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/showeditmapel_kelas",
        data: {
          id_list_mapel_kelas: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivMapel_kelas').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updmapel_kelas(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/Editmapel_kelas",
      data: {
         id_mapel_kelas: $('#id_mapel_kelas').val(),

         id_namamapel_kelas: $('#id_namamapel_kelas').val(),
         id_parent: $('#id_parent').val(),

         id_status: $('#id_status').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatamapel_kelas();
      },
      error: function(xhr){
         $('#id_DivMapel_kelas').html("error");
      }
    });
  }

  function Delmapel_kelas(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/delmapel_kelas",
        data: {
          id_list_mapel_kelas: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatamapel_kelas();
        },
        error: function(xhr){
           $('#id_DivMapel_kelas').html("error");
        }
      });
    }
  }

</script>

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
                $('#id_tam').datepicker({
                    autoclose: true
                });
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

           id_namamateri: $('#id_namamateri').val(),
           id_parent: $('#id_parent').val(),
           id_status: $('#id_status').val()
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
         id_materi: $('#id_materi').val(),

         id_namamateri: $('#id_namamateri').val(),
         id_parent: $('#id_parent').val(),

         id_status: $('#id_status').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatamateri();
      },
      error: function(xhr){
         $('#id_DivMateri').html("error");
      }
    });
  }

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

</script>

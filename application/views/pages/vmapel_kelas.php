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

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
             <button type="button" id="id_BtnAddMapel_kelas" class="btn btn-primary btn-sm pull-right">Tambah mapel_kelas	</button>
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

<script>
	// ketika DOM ready
	$(document).ready(function(){
		GenDataMapel_kelas();
	});

// ketika tombol tambah Mapel_kelas di klik
  $(document).on('click', '#id_BtnAddMapel_kelas', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add ppn
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
                             id_is: "required",
                             id_nama: "required",
                             id_jk: "required",
                             id_tel: "required",
                             id_tam: "required",
                             id_agama: "required",
                             id_alamat: "required",
                             id_tm: "required",
                             id_status: "required"
                         },
                         messages: {
                             id_is: "isi dengan benar",
                             id_nama: "isi dengan benar",
                             id_jk: "isi dengan benar",
                             id_tel: "isi dengan benar",
                             id_tam: "isi dengan benar",
                             id_agama: "isi dengan benar",
                             id_alamat: "isi dengan benar",
                             id_tm: "isi dengan benar",
                             id_status: "isi dengan benar",
                        }
                     });
                 });
          SaveMapel_kelas();
              },
              error: function(xhr){
                 $('#id_MdlDefault').html("error");
              }
          });
   });

	// function untuk populate data user dari table database
	function GenDataMapel_kelas(){
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
    $(document).on('click', '#id_mapel_kelasbtn', function(e){
      e.preventDefault();
              if($('#id_FrmAddMapel_kelas').valid()){
                // jika validasi berhasil
                 jQuery.ajax({
                     type: "POST",
                     url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel_kelas/savemapel_kelas",
                     data: {

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
                        alert("Data saved!");
                         GenDataMapel_kelas();
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


</script>

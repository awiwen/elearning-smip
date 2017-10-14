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
          <h3 class="box-title">Data Kelas</h3>
             <button type="button" id="id_BtnAddKelas" class="btn btn-primary btn-sm pull-right">Tambah Kelas	</button>
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

<script>
	// ketika DOM ready
	$(document).ready(function(){
		GenDataKelas();
	});

// ketika tombol tambah Kelas di klik
  $(document).on('click', '#id_BtnAddKelas', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add ppn
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
                             id_nama: "required",
                             id_parent: "required",
                             id_urutan: "required",
                             id_aktif: "required",

                         },
                         messages: {

                             id_nama: "isi dengan benar",
                             id_parent_id: "isi dengan benar",
                             id_urutan: "isi dengan benar",
                             id_aktif: "isi dengan benar",

                        }
                     });
                 });
          SaveKelas();
              },
              error: function(xhr){
                 $('#id_MdlDefault').html("error");
              }
          });
   });

	// function untuk populate data user dari table database
	function GenDataKelas(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudKelas/showKelas",
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
    $(document).on('click', '#id_kelasbtn', function(e){
      e.preventDefault();
              if($('#id_FrmAddKelas').valid()){
                // jika validasi berhasil
                 jQuery.ajax({
                     type: "POST",
                     url: "<?php echo base_url(); ?>" + "index.php/ccrudkelas/savekelas",
                     data: {

                         id_nip: $('#id_is').val(),
                         id_nama: $('#id_nama').val(),
                         id_jk: $('#id_jk').val(),
                         id_tel: $('#id_tel').val(),
                         id_alamat: $('#id_alamat').val(),
                         id_status: $('#id_status').val()
                     },
                     success: function(res) {
                        $('#modal-default').modal('hide');
                        alert("Data saved!");
                         GenDataKelas();
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


</script>

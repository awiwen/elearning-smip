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

        <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Default box -->

			<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Siswa</h3>

        </div>
        <div class="box-body">
         <div id="id_DivSiswa">
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
		GenDatasiswa();
	});

	// function untuk populate data user dari table database
	function GenDatasiswa(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/showsiswa",
            success: function(res) {
                $('#id_DivSiswa').html(res);
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
               $('#id_DivSiswa').html("error");
            }
        });
	}

  //Saat Tombol Edit di Klik
  function EditSiswa(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruddsiswa/showeditsiswa",
        data: {
          id_list_siswa: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivSiswa').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updsiswa(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccruddsiswa/Editsiswa",
      data: {
         id_siswa: $('#id_siswa').val(),
         id_nip: $('#id_nip').val(),
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
        GenDatasiswa();
      },
      error: function(xhr){
         $('#id_DivSiswa').html("error");
      }
    });
  }

</script>

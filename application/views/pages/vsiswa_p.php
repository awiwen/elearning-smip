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
        url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa_p/showsiswa",
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

</script>

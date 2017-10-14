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
			<div class="container-fluid">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pengajar</h3>
             <button type="button" id="id_BtnAddPengajar" class="btn btn-primary btn-sm pull-right">Tambah Pengajar	</button>
        </div>
        <div class="box-body">
         <div id="id_DivPengajar">
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

<script>
	// ketika DOM ready
	$(document).ready(function(){
		GenDataPengajar();
	});

// ketika tombol tambah pengajar di klik
  $(document).on('click', '#id_BtnAddPengajar', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add pengajar
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudpengajar/addpengajar",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                autoclose: true
                });

          Savepengajar();
              },
              error: function(xhr){
                 $('#id_MdlDefault').html("error");
              }
          });
   });

	// function untuk populate data user dari table database
	function GenDataPengajar(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudPengajar/showPengajar",
            success: function(res) {
                $('#id_DivPengajar').html(res);
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
               $('#id_DivPengajar').html("error");
            }
        });
	}

  // save user
	function Savepengajar(){
    $(document).on('click', '#id_pengajarbtn', function(){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudpengajar/savepengajar",
        data: {
					id_nip: $('#id_is').val(),
					id_nama: $('#id_nama').val(),
					id_jk: $('#id_jk').val(),
					id_tel: $('#id_tel').val(),
					id_tam: $('#id_tam').val(),
					id_alamat: $('#id_alamat').val(),
					id_status: $('#id_status').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDataPengajar();
        },
            error: function(xhr){
               $('#id_DivPengajar').html("error");
            }
        });
    })
  }
	//Saat Tombol Edit di Klik
	function EditPengajar(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudpengajar/showeditpengajar",
				data: {
					id_list_pengajar: id
				},
				success: function(res) {
					$('#id_MdlDefault').html(res);
					//Date picker
					$('#id_tam').datepicker({
							autoclose: true
					});
				},
				error: function(xhr){
					 $('#id_DivPengajar').html("error");
				}
			});
	}

	//Saat tombol save change di klik
	function UpdPengajar(){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/ccrudpengajar/EditPengajar",
			data: {
				 id_pengajar: $('#id_pengajar').val(),
				 id_nip: $('#id_nip').val(),
				 id_nama: $('#id_nama').val(),
				 id_jk: $('#id_jk').val(),
				 id_tel: $('#id_tel').val(),
				 id_tam: $('#id_tam').val(),
				 id_alamat: $('#id_alamat').val(),
				 id_status: $('#id_status').val()
			},
			success: function(res) {
				$('#modal-default').modal('hide');
				alert("Data Updated!");
				GenDataPengajar();
			},
			error: function(xhr){
				 $('#id_DivPengajar').html("error");
			}
		});
	}

	//Saat tombol delete di klik
	function DelPengajar(id){
		var delconf = confirm("Hapus data?");
		if(delconf){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudpengajar/delpengajar",
				data: {
					id_list_pengajar: id
				},
				success: function(res) {
					$('#modal-default').modal('hide');
					alert("Data Terhapus!");
					GenDataPengajar();
				},
				error: function(xhr){
					 $('#id_DivPengajar').html("error");
				}
			});
		}
	}

</script>

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
             <button type="button" id="id_BtnAddSiswa" class="btn btn-primary btn-sm pull-right">Tambah Siswa	</button>
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
		GenDataSiswa();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddSiswa', function(){
    // tampilkan modal
    $('#modal-default').modal({
                    cache:false,
                    backdrop: 'static',
                    keyboard: false
                }, "show");
    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/addsiswa",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
        SaveSiswa();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDataSiswa(){
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

  // save user
  function SaveSiswa(){
    $(document).on('click', '#id_siswabtn', function(){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/savesiswa",
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
					console.log($('#id_agama').val());
          $('#modal-default').modal( 'hide');
					 window.location.reload();
          alert("Data saved!" + res);
          GenDataSiswa();
        },
            error: function(xhr){
               $('#id_DivSiswa').html("error");1
            }
        });
    })
  }

  //Saat Tombol Edit di Klik
  function EditSiswa(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/showeditsiswa",
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
  function UpdSiswa(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/EditSiswa",
      data: {
         id_siswa: $('#id_siswa').val(),
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
        alert("Data Updated!");
        GenDataSiswa();
      },
      error: function(xhr){
         $('#id_DivSiswa').html("error");
      }
    });
  }

  function DelSiswa(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/delsiswa",
        data: {
          id_list_siswa: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDataSiswa();
        },
        error: function(xhr){
           $('#id_DivSiswa').html("error");
        }
      });
    }
  }

</script>

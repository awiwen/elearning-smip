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
		GenDatasiswa();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddSiswa', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
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
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddSiswa').validate({
												 rules:{
													 id_is: {
		 												 required: true,
		 												 maxlength: 5
		 											},
		 											id_nama: "required",
													id_tel: "required",
													id_tam: "required",
													id_alamat: "required",
		 											id_tm: "required"
		 									},
		 									messages: {
		 											id_is: "isi NIS dengan benar",
													id_nama: "isi Nama dengan benar",
													id_tel: "isi Tempat Lahir dengan benar",
													id_tam: "isi tanggal lahir dengan benar",
													id_alamat: "isi alamat dengan benar",
		 											id_tm: "isi tahun masuk dengan benar"
												}
										 });
								 });

        SaveSiswa();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

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

  // save user
  function SaveSiswa(){
		$(document).off('click','#id_siswabtn');
    $(document).on('click', '#id_siswabtn', function(e){

			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddSiswa').valid()){

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
         $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatasiswa();
        },
            error: function(xhr){
               $('#id_DivSiswa').html("error");
            }
        });

			} else {
		// dan jika gagal
			 return false;
			}

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
  function Updsiswa(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudsiswa/Editsiswa",
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

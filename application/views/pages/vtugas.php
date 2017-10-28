
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
          <h3 class="box-title">Data Tugas</h3>
             <button type="button" id="id_BtnAddTugas" class="btn btn-primary btn-sm pull-right">Tambah Tugas	</button>
        </div>
        <div class="box-body">
         <div id="id_DivTugas">
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
		GenDatatugas();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddTugas', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/addtugas",
            success: function(res) {
                $('#id_MdlDefault').html(res);
								// rubah editor
								CKEDITOR.replace( 'id_konten' );

								$('#id_ttutup, #id_ttampil').datepicker({
			              autoclose: true
			          });
								// form validation on ready state
                 $().ready(function(){
                     $('#id_FrmAddTugas').validate({
                         rules:{
                             id_judul: "required",
														 id_konten: "required",
														 id_ttampil: "required",
														 id_ttutup: "required"
                         },
                         messages: {
                             id_judul: "isi Judul Tugas dengan benar",
														 id_konten: "isi Konten dengan benar",
														 id_ttutup: "isi Tanggal Tutup dengan benar"
                        }
                     });
                 });
								 id_ttampil: "isi Tanggal Tampil dengan benar",

                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
        SaveTugas();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })




	// function untuk populate data user dari table database
	function GenDatatugas(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/showtugas",
            success: function(res) {
                $('#id_DivTugas').html(res);
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
               $('#id_DivTugas').html("error");
            }
        });
	}

  // save user
  function SaveTugas(){
		$(document).off('click','#id_tugasbtn');
    $(document).on('click', '#id_tugasbtn', function(e){
			e.preventDefault();

//			console.log(
//			$('#id_judul').val() + "," +
//		 	CKEDITOR.instances.id_konten.getData()  + "," +
//			$('#id_ttampil').val() + "," +
//			$('#id_ttutup').val() + "," +
//			$('#id_asiswa').val() + "," +
//			$('#id_apengajar').val()
//		);

//			return false;
      if($('#id_FrmAddTugas').valid()){
	      jQuery.ajax({
	        type: "POST",
	        url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/savetugas",
	        data: {
	           id_judul: $('#id_judul').val(),
						 id_konten: CKEDITOR.instances.id_konten.getData(),
						 id_ttampil: $('#id_ttampil').val(),
						 id_ttutup: $('#id_ttutup').val(),
						 id_asiswa: $('input[name=radio1]:checked').val(),
						 id_apengajar: $('input[name=radio2]:checked').val()
	        },
	              success: function(res) {
	         $('#modal-default').modal('hide');
	          alert("Data saved!" + res);
	          GenDatatugas();
	        },
	            error: function(xhr){
	               $('#id_DivTugas').html("error");
	            }
	        });
			} else {
				// dan jika gagal
				 return false;
				}
    })
  }

  //Saat Tombol Edit di Klik
  function EditTugas(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/showedittugas",
        data: {
					id : id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_ttutup, #id_ttampil').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivTugas').html("error");
        }
      });
  }

	function DetailTugas(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/showdetailtugas",
				data: {
					id_list_tugas: id
				},
				success: function(res) {
					$('#id_MdlDefault').html(res);
					//Date picker
					$('#id_tm').datepicker({
							autoclose: true
					});
					$('#id_judul').attr('readonly', true);
					$('#id_konten2').attr('readonly', true);
					$('#id_ttampil').attr('readonly', true);
					$('#id_ttutup').attr('readonly', true);
					$('input[name="radio1"]').attr('disabled', 'disabled');
					$('input[name="radio2"]').attr('disabled', 'disabled');
				},
				error: function(xhr){
					 $('#id_DivTugas').html("error");
				}
			});
	}

  //Saat tombol save change di klik
  function Updtugas($id){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/Edittugas",
      data: {
         id_peng: $id,
         id_judul: $('#id_judul').val(),
				 id_konten2: CKEDITOR.instances.id_konten2.getData(),
         id_ttampil: $('#id_ttampil').val(),
				 id_ttutup: $('#id_ttutup').val(),
				 id_asiswa: $('input[name=radio1]:checked').val(),
				 id_apengajar: $('input[name=radio2]:checked').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatatugas();
      },
      error: function(xhr){
         $('#id_DivTugas').html("error");
      }
    });
  }

  function DelTugas(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas/deltugas",
        data: {
          id_list_tugas: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatatugas();
        },
        error: function(xhr){
           $('#id_DivTugas').html("error");
        }
      });
    }
  }

</script>

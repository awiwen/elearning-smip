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

	// function untuk populate data user dari table database
	function GenDatatugas(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/showtugas",
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

	//detail tugas
	function DetailTugas(id){
		$('#modal-default').modal('show');
		jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/showdetailtugas",
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
					$('#id_tbuat').attr('readonly', true);
					$('#id_selesai').attr('readonly', true);
					$('input[name="radio1"]').attr('disabled', 'disabled');
					$('input[name="radio2"]').attr('disabled', 'disabled');
				},
				error: function(xhr){
					 $('#id_DivTugas').html("error");
				}
			});
	}

	function TugasJawaban(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/showtugasjawaban",
        data: {
          id_list_tugas: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tbuat').datepicker({
              autoclose: true
          });
					$('#id_tselesai').datepicker({
              autoclose: true
          });

					$().ready(function(){
							$('#id_FrmAddTugas').validate({
									rules:{
							 //			 id_ppnnik: {
							 //					required: true,
							 //					maxlength: 5
							 //			 },
											id_siswa:"required"
									},
									messages: {
											id_siswa: "siswa tidak boleh kosong"
								 }
							});
					});
        },
        error: function(xhr){
           $('#id_DivTugas').html("error");
        }
      });
  }

	// save user
	function Savejawaban(){
		$(document).off('click','#id_Btnjawaban');
		$(document).on('click', '#id_Btnjawaban', function(e){
			// falidasi
			e.preventDefault();

			$tbuat = $('#id_tbuatj').val();
			$tselesai = $('#id_tselesai').val();

			if ($tbuat < $tselesai) {
				console.log("true");

			if($('#id_FrmAddJawaban').valid()){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/savejawaban",
				data: {
					id_tugas_id: $('#id_tugas_id').val(),
					id_tbuatj: $('#id_tbuatj').val(),
					id_siswa: $('#id_siswa').val()
				},
							success: function(res) {
					$('#modal-default').modal('hide');
					alert(res);
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
			} else {
				alert("Waktu menjawab sudah habis!!! !");
			}
		})
	}

	//Saat Tombol upload di Klik
	function UploadJawaban(tugas_jawaban_id){
			$('#modal-default').modal('show');
			jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/showuploadjawaban",
					data: {
							tugas_jawaban_id: tugas_jawaban_id
					},
					success: function(res) {
							$('#id_MdlDefault').html(res);
							UploadPDFJawaban(tugas_jawaban_id);
					},
					error: function(xhr){
							$('#id_DivTugas').html("error");
					}
			});
	}

	function UploadPDFJawaban(tugas_jawaban_id){
			event.preventDefault();
			$('#upload').on('click', function () {
					var file_data = $('#file').prop('files')[0];
					var form_data = new FormData();
					console.log(form_data);
					form_data.append('file', file_data);
					$.ajax({
							url: "<?php echo base_url(); ?>" + "index.php/ccrudtugas_s/upload_jawaban/"+tugas_jawaban_id,
							dataType: 'text',
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,
							type: 'post',
							beforeSend: function(){
									$('.modal-body').html("Tunggu, lagi upload nih...!");
							},
							success: function (response) {
								console.log(response);
								$('#modal-default').modal('hide');
									$('.modal-body').html(response);
									GenDatatugas();
							},
							error: function (response) {
								console.log(response);
									$('.modal-body').html(response);
							}
					});
			});
	}

</script>

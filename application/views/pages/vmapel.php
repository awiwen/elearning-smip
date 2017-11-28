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
          <h3 class="box-title">Data Matapelajaran</h3>
             <button type="button" id="id_BtnAddMapel" class="btn btn-primary btn-sm pull-right">Tambah Matapelajaran	</button>
        </div>
        <div class="box-body">
         <div id="id_DivMapel">
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
		GenDatamapel();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddMapel', function(){
    // tampilkan modal
    $('#modal-default').modal('show');
    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/addmapel",
            success: function(res) {
                $('#id_MdlDefault').html(res);

								// form validation on ready state
                 $().ready(function(){
                     $('#id_FrmAddMapel').validate({
                         rules:{
                             id_namamapel: "required",
														 id_info: "required"
                         },
                         messages: {
                             id_namamapel: "isi Nama Matapelajaran dengan benar",
														 id_info: "isi Info Tambahan dengan benar"

                        }
                     });
                 });

                //Date picker
                $('#id_tam').datepicker({
                    autoclose: true
                });
        SaveMapel();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatamapel(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/showmapel",
            success: function(res) {
                $('#id_DivMapel').html(res);
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
               $('#id_DivMapel').html("error");
            }
        });
	}

  // save user
  function SaveMapel(){
		$(document).off('click','#id_mapelbtn');
    $(document).on('click', '#id_mapelbtn', function(e){

			e.preventDefault();
            	if($('#id_FrmAddMapel').valid()){

      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/savemapel",
        data: {
           id_namamapel: $('#id_namamapel').val()
        },
              success: function(res) {
         $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatamapel();
        },
            error: function(xhr){
               $('#id_DivMapel').html("error");
            }
        });
			} else {
			// dan jika gagal
				 return false;
				}
    })
  }

  //Saat Tombol Edit di Klik
  function EditMapel(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/showeditmapel",
        data: {
          id_list_mapel: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker

          $('#id_tm').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivMapel').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Updmapel(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/Editmapel",
      data: {
				 id_mapel: $('#id_mapel').val(),
				 id_namamapel: $('#id_namamapel').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatamapel();
      },
      error: function(xhr){
         $('#id_DivMapel').html("error");
      }
    });
  }

  function DelMapel(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccrudmapel/delmapel",
        data: {
          id_list_mapel: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatamapel();
        },
        error: function(xhr){
           $('#id_DivMapel').html("error");
        }
      });
    }
  }

</script>

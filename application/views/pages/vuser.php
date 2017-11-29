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
          <a  id="id_BtnAddUser" class="btn btn-primary">Tambah User</a>

        </div>

        <div class="box-body">
         <div id="id_DivUser">
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
		GenDatauser();
	});

// ketika tombol tambah user di klik
  $(document).on('click', '#id_BtnAddUser', function(){
    // tampilkan modal
    $('#modal-default').modal('show');

    // isi modal dengan form add user
    jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccruduser/adduser",
            success: function(res) {
                $('#id_MdlDefault').html(res);
                //Date picker
                // $('#id_tam').datepicker({
                //     autoclose: true
                // });
								// form validation on ready state
								 $().ready(function(){
										 $('#id_FrmAddUser').validate({
												 rules:{
                           id_username: "required",
                            id_password1: {
                              required: true,
                              minlength: 5
                            },
                            id_password2: {
                              equalTo: "#id_password1"
                            }
												 },
												 messages: {
                            id_username: "username tidak boleh kosong",
                            id_password1: "password tidak boleh kosong",
                            id_password1: "password harus lebih dari 5 karakter",
                            id_password2: {
                              equalTo: "Password tidak sama"
                            }
												}
										 });
								 });

        SaveUser();
            },
            error: function(xhr){
               $('#id_MdlDefault').html("error");
            }
        });
  })

	// function untuk populate data user dari table database
	function GenDatauser(){
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/ccruduser/showuser",
            success: function(res) {
                $('#id_DivUser').html(res);
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
               $('#id_DivUser').html("error");
            }
        });
	}

  // save user
  function SaveUser(){
		$(document).off('click','#id_userbtn');
    $(document).on('click', '#id_userbtn', function(e){
			// falidasi
			e.preventDefault();
            	if($('#id_FrmAddUser').valid()){

			jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruduser/saveuser",
        data: {

           id_username: $('#id_username').val(),
           id_password1: $('#id_password1').val(),
           id_admin: $('#id_admin').val(),
           id_pengajar: $('#id_pengajar').val(),
           id_siswa: $('#id_siswa').val()
        },
              success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data saved!" + res);
          GenDatauser();
        },
            error: function(xhr){
               $('#id_DivUser').html("error");
            }
        });
							} else {
						// dan jika gagal
							 return false;
							}
    })
  }


  //Saat Tombol Edit di Klik
  function EditUser(id){
    $('#modal-default').modal('show');
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruduser/showedituser",
        data: {
          id_list_user: id
        },
        success: function(res) {
          $('#id_MdlDefault').html(res);
          //Date picker
          $('#id_tam').datepicker({
              autoclose: true
          });
        },
        error: function(xhr){
           $('#id_DivUser').html("error");
        }
      });
  }

  //Saat tombol save change di klik
  function Upduser(){
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/ccruduser/Edituser",
      data: {
         id_user: $('#id_user').val(),

         id_namauser: $('#id_namauser').val(),
         id_parent: $('#id_parent').val()
      },
      success: function(res) {
        $('#modal-default').modal('hide');
        alert("Data Updated!");
        GenDatauser();
      },
      error: function(xhr){
         $('#id_DivUser').html("error");
      }
    });
  }

  function DelUser(id){
    var delconf = confirm("Hapus data?");
    if(delconf){
      jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/ccruduser/deluser",
        data: {
          id_list_user: id
        },
        success: function(res) {
          $('#modal-default').modal('hide');
          alert("Data Terhapus!");
          GenDatauser();
        },
        error: function(xhr){
           $('#id_DivUser').html("error");
        }
      });
    }
  }

</script>

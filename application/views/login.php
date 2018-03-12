<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logo.png">

	<title>E-LEARNING SMK TI MENGWITANI</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<div class="login-page bk-img" style="background-image: url(<?php echo base_url(); ?>assets/img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form action="" class="mt">

									<label for="" class="text-uppercase text-sm">Username/NIS</label>
									<input type="text" id="id_FrmLoginEmail" placeholder="Username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" id="id_FrmLoginPassw" placeholder="Password" class="form-control mb">

									<!-- <div class="checkbox checkbox-circle checkbox-info">
										<input id="checkbox7" type="checkbox" checked>
										<label for="checkbox7">
											Keep me signed in
										</label>
									</div> -->

									<button class="btn btn-primary btn-block" type="submit" id="id_BtnLogin" >LOGIN</button>

								</form>
							</div>
						</div>
						<!-- <div class="text-center text-light">
							<a href="#" class="text-light">Forgot password?</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/chartData.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
	</script>
</body>
</html>
<style>
.login-page, .register-page {
    background: #d2d6de none repeat scroll 0 0;
}
</style>

<script>
  $(document).on('click', '#id_BtnLogin', function(event){
    event.preventDefault();
    var email = $('#id_FrmLoginEmail').val();
    var passw = $('#id_FrmLoginPassw').val();
    jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/clogin/auth",
      data: {email: email, passw: passw},
      success: function(res) {
					alert("login sukses");
          if(res==true){
              window.location.href = "<?php echo base_url(); ?>" + "index.php/ctrlpages";
          } else {
              alert("Invalid email or password");
          }
      }
    });
  })
</script>

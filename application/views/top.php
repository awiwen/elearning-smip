<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>Harmony - Free responsive Bootstrap admin template by Themestruck.com</title>

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
	<!-- css time picker -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-material-datetimepicker.css" /> -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-clockpicker.css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/clockface/css/clockface.css" />
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>

		<script src="<?php echo base_url(); ?>assets/clockface/js/clockface.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?=base_url()?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-material-datetimepicker.js"></script> -->

</head>

<body>
	<div class="brand clearfix">
		<a href="<?=base_url()?>index.php/ctrlpages" class="logo"><img src="<?php echo base_url(); ?>assets/img/tulis.png" class="img-responsive" alt=""></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<!-- <li><a href="<?=base_url()?>index.php/ctrlpages/help">Help</a></li> -->

			<li class="ts-account">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notifikasi Pesan <span class="badge badge-danger" id="load_row"><?=$jlhnotif?></span></a>
				<ul>
					<!-- <li><a href="#">My Account</a></li> -->
						<?php $no=0; foreach($notifikasi as $rnotif){ $no++;
								if($no % 2==0){$strip='strip1';}  //agar pesan yang tampil striped beda warna
								else{$strip='strip2';}
						?>
						<li><a href="<?php echo $rnotif->link ?>" class="<?=$strip?>">
						<?=$rnotif->pesan?>     <br>
						<small><b><?=$rnotif->oleh?> </b><?=$rnotif->tgl?></small>
						</a>
						</li>
					<?php }?>
				</ul>
			</li>
			<li class="ts-account">
				<a href="#"><img src="<?php echo base_url(); ?>assets/img/ts-avatar1.png" class="ts-avatar hidden-side" alt=""> <?php echo $this->session->userdata('username') ?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="#">My Account</a></li>
					<li><a href="<?php echo base_url('index.php/clogin/logout'); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>
	</div>
</body>

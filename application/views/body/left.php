<?php
  $apptitle = $this->session->userdata('apptitle');
  $appver = $this->session->userdata('appver');
  $email = $this->session->userdata('email');
  $passw = $this->session->userdata('passw');
  $level = $this->session->userdata('level');
  $login_state = $this->session->userdata('login_state');
?>

<div class="ts-main-content">
  <nav class="ts-sidebar">
    <ul class="ts-sidebar-menu">
      <a href="<?=base_url()?>index.php/ctrlpages" class="logo"><img src="<?php echo base_url(); ?>assets/img/logo.png" class="img-responsive" alt=""></a>
    </ul>
    <ul>
        <li class="header">MAIN NAVIGATION</li>
        <?php
        if ($level == 'Admin') {
          $this->load->view('body/menu/menu_adm');
        } elseif ($level == 'Pengajar') {
          $this->load->view('body/menu/menu_pengajar');
        } elseif ($level == 'Siswa') {
          $this->load->view('body/menu/menu_siswa');
        } else {
          echo '<script>alert("User level not recognize")</script>';
        }
        ?>
    </ul>
    </nav>

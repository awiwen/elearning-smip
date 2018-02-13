<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdetailpengumuman extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

public function showdetailpengumuman($id){
  echo $id;
  $this->db->query("UPDATE notifikasi set status_id=2 where login_id = '".$this->session->userdata('login_id')."' and pengumuman_id='".$id."'");

  $id_login = $this->session->userdata('login_id');
  $this->load->model('mnotifikasi');//judul title
  $data['jlhnotif'] =$this->mnotifikasi->notif_count($id_login,1);  //menghitung jumlah post
  $data['notifikasi'] =$this->mnotifikasi->getnotifikasi($id_login,1); //menampilkan isi postingan

  $this->load->view('top.php', $data);
  $this->load->view('lef.php');
  ?>
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
      <section class="content-header" style="margin:100px 0 0 250px;">
        <div class="container-fluid">
        <h1>
          Detail Pengumuman
        </h1>
         <ol class="breadcrumb">

          <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
          <li class="active">detailpengumuman</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content" style="margin:0 0 0 250px;">
        <div class="container-fluid">

        <!-- Default box -->

  			<div class="box">
          <div class="panel-body">
          <div class="box-header with-border">


          </div>

          <table class="table table-bordered table-striped">
           <?php
           $this->load->model('mdetailpengumuman');
           $query=$this->mdetailpengumuman->selectdetailpengumuman($id);
           foreach($query->result() as $row){
             ?>
               <tr>
                 <td width="20%"><b>Judul</td></b>
                 <td width="80%"><?php echo $row->judul?></td>
               </tr>
               <tr>
                 <td><b>Konten</td></b>
                 <td><?php echo $row->konten?></td>
               </tr>
               <tr>
                 <td><b>Tanggal Tampil</td></b>
                 <td><?php echo $row->tgl_tam?></td>
               </tr>
               <tr>
                 <td><b>tanggal Tutup</td></b>
                 <td><?php echo $row->tgl_tut ?></td>
               </tr>
               <tr>
                 <td><b>file</td></b>
                 <td>
                 <a href="<?php echo base_url(); ?>assets/filepengumuman/<?=$row->file?>"
                   download="<?=$row->file?>"><?=$row->file?></a>
                 </td>
               </tr>

               <?php
               // $i++;
               }
               ?>
               </table>
          </div>
          <!-- /.box-body -->
            </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    </div>
    </div>



  <?php
  $this->load->view('bot.php');
}

}

?>

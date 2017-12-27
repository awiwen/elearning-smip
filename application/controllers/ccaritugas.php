<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccaritugas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

public function showcaritugas(){
  // echo $id;
  $this->db->query("UPDATE notifikasi set status_id=2 where login_id = '".$this->session->userdata('login_id')."'");

  $this->load->model('mnotifikasi');//judul title
  // $data['jlhnotif'] =$this->mnotifikasi->notif_count($id,1);  //menghitung jumlah post
  // $data['notifikasi'] =$this->mnotifikasi->getnotifikasi($id,1); //menampilkan isi postingan

  $this->load->view('topsearch.php');
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
          Cari Tugas
        </h1>
         <ol class="breadcrumb">

          <li><a href="#"><i class="fa fa-files-o"></i> MENU KELOLA</a></li>
          <li class="active">caritugas</li>
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
          <div class="panel-body">
					<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <!-- <th width="5%">No</th> -->
                <th width="15%">Tanggal Buat</th>
                <th width="15%">Tanggal Selesai</th>
                <th width="15%">Judul Tugas</th>
                <!-- <th width="30%">Konten</th> -->
                <th width="5%">File</th>
                <th width="15%">Matapelajaran</th>
                <th width="20%">Pengajar</th>
                <th width="15%">Kelas</th>
              </tr>
            </thead>
            <?php
            $this->load->model('mcrudtugas');
                $query = $this->mcrudtugas->showtugascari();
            $i = 1;
            foreach($query->result() as $jawaban){
              ?>
                <tr>
                  <!-- <td><?php echo $i ?></td> -->
                  <td><?php echo $jawaban->tgl_buat?></td>
                  <td><?php echo $jawaban->tgl_selesai?></td>
                  <td><?php echo $jawaban->judul?></td>
                  <!-- <td><?php echo $jawaban->konten?></td> -->
                  <td>
                    <a href="<?php echo base_url(); ?>assets/filejawaban/<?=$jawaban->file.'.pdf'?>"
                      download="<?=$jawaban->file.'.pdf'?>"><?=$jawaban->file?></a>
                  </td>
                  <td><?php echo $jawaban->nama_mapel?></td>
                  <td><?php echo $jawaban->nama?></td>
                  <td><?php echo $jawaban->nama_kelas?></td>
                </tr>
        <?php
        $i++;
        }
        ?>
          </table>
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



  <?php
  $this->load->view('bot.php');
}

}

?>

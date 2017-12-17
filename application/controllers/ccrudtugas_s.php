<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudtugas_s extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
  $this->load->helper('url');
}

function showtugas(){
  ?>
  <div class="col-lg">
    <?php
    $this->load->model('mcrudtugas');
    $query = $this->mcrudtugas->selectParent();

    $i = 1;
    foreach($query->result() as $row){

      ?>
    <!-- <div class="panel panel-default"> -->

      <!-- <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div>  KELAS X -->
      <!-- <div class="panel-body"> -->

        <div class="col-lg">
          <?php
          $query = $this->mcrudtugas->selectkelas_s($this->session->userdata('siswa_id'));

          $i = 1;
          foreach($query->result() as $kelas){

            ?>

          <div class="panel panel-default">
            <div class="panel-heading"> <h4> <?php echo $kelas->nama_kelas;?> </div> <!-- KELAS X TKJ-->
            <div class="panel-body">

              <?php
              $this->load->model('mcrudtugas');
                $query = $this->mcrudtugas->showmapel($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $mapel){
                ?>

              <div class="panel panel-default"> <!-- MAPEL -->
                <div class="panel-heading"> <h4> <?php echo $mapel->nama_mapel;?> </div> <!-- MAPEL -->
                <div class="panel-body">

              <div class="panel-body"> <!-- tugas-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Tugas</th>
                      <th width="20%">Tanggal Buat</th>
                      <th width="20%">Tanggal Selesai</th>
                      <th width="10%">File</th>
                      <th width="30%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudtugas');
                      $query = $this->mcrudtugas->showtugas($mapel->mapel_id,$kelas->kelas_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->judul?></td>
                        <td><?php echo $row->tgl_buat?></td>
                        <td><?php echo $row->tgl_selesai?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>assets/filetugas/<?=$row->file.'.pdf'?>"
                            download="<?=$row->file.'.pdf'?>"><?=$row->file?></a>
                        </td>

                        <td>
                          <button onclick="DetailTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="TugasJawaban(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Jawab</button>
                        </td>
                      </tr>
              <?php
              $i++;
              }
              ?>
                </table>
              </div>

            </div>
          </div>
          <?php
          }
          ?>
        </div>


      </div>

            </div>
          <!-- </div> -->
          <?php
          }
          ?>
        <!-- </div> -->


      </div>
    </div>

    <?php
    }
    ?>
  </div>

  <?php
}

public function showuploadjawaban(){
    $this->load->model('mcrudtugas');
    $query=$this->mcrudtugas->selectjawabanup();
    foreach($query->result() as $row){
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Upload Tugas</h4>
        </div>
        <div class="modal-body" style="display: inline-flex">
            <input type="file" id="file" name="file" accept="assets/filejawaban"/> <button id="upload">Upload</button>
            <span id="msg"></span>
        </div>
        <?php
    }
}

public function showdetailtugas(){
  $this->load->model('mcrudtugas');
  $query=$this->mcrudtugas->selectdetailtugas();
  foreach($query->result() as $tugas){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail tugas</h4>
  </div>
  <style>
    #modal_body{
      font-size: 16px;
      font-weight: normal;
    }
  </style>
  <div class="modal-body" id="modal_body">
    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" placeholder="Ketik Nama Matapelajaran" value="<?=$tugas->judul?>" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten2" name="id_konten2" placeholder="Ketik Konten" value="" required><?=$tugas->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Buat</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tbuat" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tbuat" value="<?=$tugas->tgl_buat?>"required readonly>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tanggal Selesai</label>
        <input type="text" class="form-control" id="id_tselesai" name="id_tselesai" placeholder="Ketik Duradi / Menit" value="<?=$tugas->tgl_selesai?>"required readonly>
        <label for="id_is" class="error"></label>
      </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label><br>
              <select id="id_mapel" class="btn dropdown-toggle btn-default" name="id_mapel" required disabled>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectmapeledit();
              foreach($query->result() as $row){
                $select = '';
                if($row->mapel_id == $tugas->mapel_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->mapel_id?>"<?= $select ?>><?=$row->nama_mapel?></option>
              <?php
              }
              ?>
              </select>
    </div>

    <div class="form-group">
              <label for="pengajar">Pengajar</label><br>
              <select id="id_pengajar" class="btn dropdown-toggle btn-default" name="id_pengajar" required disabled>
              <label for="id_pengajar" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectpengajar();
              foreach($query->result() as $row){
                $select = '';
                if($row->pengajar_id == $tugas->pengajar_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->pengajar_id?>" <?= $select ?>><?=$row->nama?></option>
              <?php
              }
              ?>
              </select>
    </div>
    <div class="form-group">
              <label for="mapel">Kelas</label><br>
              <select id="id_kelas" class="btn dropdown-toggle btn-default" name="id_kelas" required disabled>
              <label for="id_kelas" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectkelasedit();
              foreach($query->result() as $row){
                $select = '';
                if($row->kelas_id == $tugas->kelas_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->kelas_id?>" <?= $select ?>><?=$row->nama_kelas?></option>
              <?php
              }
              ?>
              </select>
    </div>

 </div>
  <div class="modal-footer">
  <!--   <button id="id_BtnEdittugas" type="button" class="btn btn-primary" onclick="Updtugas(<?=$row->id?>)">Save changes</button>
  --></div>
  <style>
    .error{
    color: red;
    font-style: italic;
    }
  </style>
  <?php
  }
}

public function showtugasjawaban(){
  $this->load->model('mcrudtugas');
  $query=$this->mcrudtugas->selectdetailtugas();
  foreach($query->result() as $tugas){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail Jawaban</h4>
  </div>

  <div class="modal-body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddJawaban",
         "name" => "FrmAddJawaban"
     );
     echo form_open('ctrlpage/tugas',$frmattributes);
    ?>

  <div class="panel-body"> <!-- tugas-->
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="30%">Tanggal</th>
          <th width="20%">NIS</th>
          <th width="25%">Nama</th>
          <th width="30%">Jawaban</th>
          <th width="30%">Opsi</th>
        </tr>
      </thead>
      <?php
      $this->load->model('mcrudtugas');
          $query = $this->mcrudtugas->showjawaban($tugas->tugas_id);
      $i = 1;
      foreach($query->result() as $jawaban){
        ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $jawaban->tgl_buat?></td>
            <td><?php echo $jawaban->nis?></td>
            <td><?php echo $jawaban->nama?></td>
            <td>
              <a href="<?php echo base_url(); ?>assets/filejawaban/<?=$jawaban->file.'.pdf'?>"
                download="<?=$jawaban->file.'.pdf'?>"><?=$jawaban->file?></a>
            </td>
            <td>
            <button onclick="UploadJawaban(<?=$jawaban->tugas_jawaban_id?>)" type="button" class="btn btn-primary btn-xs">Upload</button>
          </td>
          </tr>
  <?php
  $i++;
  }
  ?>
    </table>
  </div>
 </div>

 <div class="modal-header">
       <h4 class="modal-title">Upload Tugas</h4>
   </div>

     <div class="panel-body">
        <div class="form-group">
          <label for="id">ID List</label>
          <input type="text" class="form-control" id="id_tugas_id" placeholder="Ketik Id" value="<?=$tugas->tugas_id?>" readonly>
         </div>

     <div class="form-group">
       <label for="nik">Tanggal Buat</label>
         <div class="input-group date">
           <div class="input-group-addon">
             <i class="fa fa-calendar"></i>
           </div>
         <input type="text" class="form-control pull-right" id="id_tbuatj" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tbuatj" value="<?php echo date("Y-m-d H:i:s") ?>"readonly>
       <label for="id_ttampil" class="error"></label>
         </div>
     </div>

     <div class="form-group">
       <label for="nik">Tanggal Selesai</label>
       <input type="datetime" class="form-control" id="id_tselesai" name="id_tselesai" placeholder="Ketik Duradi / Menit" value="<?=$tugas->tgl_selesai?>" readonly required>
       <label for="id_tselesai" class="error"></label>
     </div>

     <div class="form-group">
         <label for="siswa">Siswa</label><br>
           <select id="id_siswa" style="font-size:20px" class="btn dropdown-toggle btn-default" name="id_siswa" required>
             <label for="id_siswa" class="error"></label>

        <?php
           $this->load->model('mcrudtugas');
     		  $query = $this->mcrudtugas->selectsiswa();
     		foreach($query->result() as $row){
          if($row->siswa_id== $this->session->userdata('siswa_id')){
     		?>
         <option value="<?=$row->siswa_id?>">NIS: <?=$row->nis?> NAMA: <?=$row->nama?></option>
         <?php
         }
       }
         ?>
         </select>
     </div>

  <div class="modal-footer">
     <button id="id_Btnjawaban" type="button" class="btn btn-primary" onclick="Savejawaban()">Simpan</button>
  </div>

  <style>
    .error{
    color: red;
    font-style: italic;
    }
  </style>
  <?php
  }
}

  function upload_jawaban($tugas_jawaban_id) {
      //upload file
      $config['upload_path'] = './assets/filejawaban';
      $config['allowed_types'] = 'pdf|jpg|png';
      $config['max_filename'] = '255';
      $config['file_name'] = "Jawaban_" . $tugas_jawaban_id;
      $config['max_size'] = '10000'; //10 MB
      // jika file exists
      if (isset($_FILES['file']['name'])) {
          // jika file corupt
          if (0 < $_FILES['file']['error']) {
              echo 'Error during file upload' . $_FILES['file']['error'];
          } else {
              // jika file sudah ter-upload
              if (file_exists('uploads/' . $_FILES['file']['name'])) {
                  echo 'File already exists : uploads/' . $_FILES['file']['name'];
              } else {
                  $this->load->library('upload', $config);
                  // jika file gagal ter-upload
                  if (!$this->upload->do_upload('file')) {
                      echo $this->upload->display_errors();
                  } else {
                      echo 'File successfully uploaded ' . $_FILES['file']['name'];
                      // update table tb_pks
                      $datapdf = array("file" => $config['file_name']);
                      $this->db->where("tugas_jawaban_id", $tugas_jawaban_id);
                      $this->db->update("tugas_jawaban", $datapdf);
                  }
              }
          }
      } else {
          echo 'Mohon Masukan File yang akan diupload';
      }
  }

  public function Savejawaban(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->insertjawaban();
  }

  public function Detailtugas(){
   $this->load->model('mcrudtugas');
   $query = $this->mcrudtugas->detailtugas();
  }

}

?>

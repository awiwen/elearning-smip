<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudpengumuman_p extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showpengumuman(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Judul Pengumuman</th>
                <th width="15%">Tanggal Tampil</th>
                <th width="15%">Tanggal Tutup</th>
                <th width="15%">File</th>
                <th width="10%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudpengumuman');
      $query = $this->mcrudpengumuman->selectpengumuman();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row->judul?></td>
                <td><?php echo $row->tgl_tampil?></td>
                <td><?php echo $row->tgl_tutup?></td>
                <td>
                  <a href="<?php echo base_url(); ?>assets/filepengumuman/<?=$row->file?>"
                    download="<?=$row->file?>"><?=$row->file?></a>
                </td>
                <td>

                  <script>
                  function redirect(url){
                    location.href = url;
                  }
                  </script>
                  <button onclick="redirect('http://localhost/elearning-smip/index.php/cdetailpengumuman/showdetailpengumuman/<?= $row->pengumuman_id?>')"
                    type="button" class="btn btn-primary btn-xs">Detail</button>

                  <!-- <button onclick="DetailPengumuman(<?=$row->pengumuman_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button> -->
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addpengumuman(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH PENGUMUMAN</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddPengumuman",
       "name" => "FrmAddPengumuman"
   );
   echo form_open('cpage/manapengumuman',$frmattributes);
  ?>

  <style>
    #modal_body{
      font-size: 16px;
      font-weight: normal;
    }
  </style>
  <div class="modal-body" id="modal_body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddPengumuman",
         "name" => "FrmAddPengumuman"
     );
     echo form_open('ctrlpage/pengumuman',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" name="id_judul" placeholder="Ketik Nama Matapelajaran" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="info">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten" name="id_konten" placeholder="Ketik konten" required></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tampil</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="id_ttampil" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttampil" required>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tutup</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttutup" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttutup" required>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

        <div class="modal-footer">
         <button id="id_pengumumanbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showupload(){
    $this->load->model('mcrudpengumuman');
    $query=$this->mcrudpengumuman->selectpengumumanup();
    foreach($query->result() as $row){
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Upload Pengumuman</h4>
        </div>
        <div class="modal-body" style="display: inline-flex">
            <input type="file" id="file" name="file" accept="assets/filepengumuman"/> <button id="upload">Upload</button>
            <span id="msg"></span>
        </div>
        <?php
    }
}

public function showeditpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query=$this->mcrudpengumuman->selecteditpengumuman();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT PENGUMUMAN</h4>
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
      <input type="text" class="form-control" id="id_judul" placeholder="Ketik Nama Matapelajaran" value="<?=$row->judul?>" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="form-control" rows="3" id="id_konten2" name="id_konten" placeholder="Ketik Konten" value="" required><?=$row->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Tampil</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttampil" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttampil" value="<?=$row->tgl_tampil?>"required>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tutup</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttutup" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttutup" value="<?=$row->tgl_tutup?>"required>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

  <div class="modal-footer">
     <button id="id_BtnEditPengumuman" type="button" class="btn btn-primary" onclick="Updpengumuman(<?=$row->pengumuman_id?>)">Save changes</button>
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


public function showdetailpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query=$this->mcrudpengumuman->selectdetailpengumuman();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail PENGUMUMAN</h4>
  </div>
  <style>
    #modal_body{
      font-size: 16px;
      font-weight: normal;
    }
  </style>
  <div class="modal-body" id="modal_body">
    <div class="form-group">
      <label for="nama">Judul:</label></br>
      <text for="judul" ><?=$row->judul?></text>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="form-control" rows="3" id="id_konten2" name="id_konten" placeholder="Ketik Konten" value="" required><?=$row->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Tampil:</label>
        <text for="judul" ><?=$row->tgl_tampil?></text>
      <label for="id_ttampil" class="error"></label>
        </div>
    <!-- </div> -->

    <div class="form-group">
      <label for="nik">Tanggal Tutup:</label>
      <text for="judul" ><?=$row->tgl_tutup?></text>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

  <div class="modal-footer">
  <!--   <button id="id_BtnEditPengumuman" type="button" class="btn btn-primary" onclick="Updpengumuman(<?=$row->id?>)">Save changes</button>
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

function upload_file($pengumuman_id) {
    //upload file
    $config['upload_path'] = './assets/filepengumuman';
    $config['allowed_types'] = 'pdf|jpg|png';
    $config['max_filename'] = '255';
    $config['file_name'] = "pengumuman_" . $pengumuman_id;
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
                    $this->db->where("pengumuman_id", $pengumuman_id);
                    $this->db->update("pengumuman", $datapdf);
                }
            }
        }
    } else {
        echo 'Mohon Masukan File yang akan diupload';
    }
}

  public function savepengumuman(){
  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->insertpengumuman();
}

 public function Editpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->editpengumuman();
}

public function Detailpengumuman(){
 $this->load->model('mcrudpengumuman');
 $query = $this->mcrudpengumuman->detailpengumuman();
}

  public function Delpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->deletepengumuman();


}
}
?>

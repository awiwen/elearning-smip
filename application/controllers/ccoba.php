<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmapel_kelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmapel_kelas(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
     <div class="parent-kelas" id="parent-1">KELAS X</div>
      </table>
  <?php
}

public function addmapel_kelas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH mapel_kelas</h4>
  </div>
  <div class="modal-body">

        <div class="box-body">
          <div class="form-group">
            <label for="nik">NIS</label>
            <input type="text" class="form-control" id="id_is" name="id_is" placeholder="Ketik NIM" required>
                 <label for="id_ppnnik" class="error"></label>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="id_nama" placeholder="Ketik Nama" required>
                 <label for="id_nama" class="error"></label>
          </div>
          <div class="form-group">
            <label for="jabatan">Jenis Kelamin</label>
            <br>
            <input type="radio" name="jkel" value="laki-laki" checked>Laki - laki
            <input type="radio" name="jkel" value="Perempuan">Perempuan
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="nik">Tempat Lahir</label>
            <input type="text" class="form-control" id="id_tel" name="id_tel" placeholder="Tempat Lahir" required>
                 <label for="id_tel" class="error"></label>
          </div>
          <div class="form-group">
            <label for="nama">Tanggal Lahir</label>
            <div class="input-group date">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
                <input type="text" class="form-control pull-right" id="id_tam" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tam" required>
                 <label for="id_tam" class="error"></label>
          </div>
          <br>
          <div class="form-group">
            <label for="jabatan">Agama</label>
            <br>
            <select name="selectionField">
              <option value="JABAR" >Kristen Katolik </option>
              <option value="JATIM" >Kristen Protestan</option>
              <option value="JATENG" >Hindu</option>
              <option value="JATENG" >Islam</option>
              <option value="JATENG" >Budha</option>
            </select>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="nik">Alamat</label>
            <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" required></textarea>
                 <label for="id_alamat" class="error"></label>
          </div>
          <div class="form-group">
            <label for="nama">Tahun Masuk</label>
            <input type="text" class="form-control" id="id_tm" name="id_tm" placeholder="Ketik Tahun Masuk" required>
                 <label for="id_tm" class="error"></label>
          </div>
          <div class="form-group">
            <label for="jabatan">Status</label>
            <div>
              <br>
              <input type="radio" name="jkel" value="aktif " checked>aktif
              <input type="radio" name="jkel" value="blocking " checked>Blocking
              <input type="radio" name="jkel" value="Alumni ">Alumni
          </div>
          </div>
        </div>

  </div>
        <div class="modal-footer">
         <button id="id_mapel_kelasbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditppn(){
  $this->load->model('mcrudppn');
  $query=$this->mcrudppn->select1ppn();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT PIMPINAN TELKOMSEL</h4>
        </div>
       <div class="modal-body">
  <?php
     $frmattributes = array(
         "id" => "id_FrmUpdPpn",
         "name" => "FrmUpdPpn"
     );
     echo form_open('cpage/halppn',$frmattributes);
  ?>
        <div class="box-body">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="id_ppnnik" placeholder="Ketik NIK" value="<?=$row->id_pimpinan_telkomsel?>" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="id_ppnnama" name="id_ppnnama" placeholder="Ketik Nama" value="<?=$row->nama_pimpinan_telkomsel?>" required>
          <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="id_ppnjbt" name="id_ppnnama" placeholder="Ketik Jabatan" value="<?=$row->jabatan_pimpinan_telkomsel?>" required>
          </div>
        </div>
  </div>
        <div class="modal-footer">
         <button id="id_ppnbtn1" type="button" class="btn btn-primary" onclick="UpdPpn()">Save changes</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
    }
  </style>
  <?php
    echo form_close();
  }
}

  public function savemapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->insertmapel_kelas();
}

  public function editppn(){
  $this->load->model('mcrudppn');
  $query = $this->mcrudppn->updateppn();
}

  public function delppn(){
  $this->load->model('mcrudppn');
  $query = $this->mcrudppn->deleteppn();


}
}
?>

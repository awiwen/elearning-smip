<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudkelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showkelas(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Nama Kelas</th>
                <th width="10%">Parent</th>
                <th width="10%">Urutan</th>
                <th width="10%">Aktif</th>

            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudkelas');
          $query = $this->mcrudkelas->selectkelas();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row->nama_kelas ?></td>
                <td><?php echo $row->parent_id?></td>
                <td><?php echo $row->urutan ?></td>
                <td><?php echo $row->aktif ?></td>
                <td>
                  <button onclick="EditPpn(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelPpn(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addkelas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH kelas</h4>
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

    </div>
    <div class="box-body">
      <div class="form-group">
        <label for="nik">Alamat</label>
        <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" required></textarea>
             <label for="id_alamat" class="error"></label>
      </div>

    </div>

  </div>
        <div class="modal-footer">
         <button id="id_kelasbtn" type="button" class="btn btn-primary">Simpan</button>
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
          <h4 class="modal-title">EDIT kelas</h4>
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

  public function savekelas(){
  $this->load->model('mcrudkelas');
  $query = $this->mcrudkelas->insertkelas();
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

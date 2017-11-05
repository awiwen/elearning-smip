<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudpengajar extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showpengajar(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="3%">No</th>
                <th width="5%">NIP</th>
                <th width="10%">Nama</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="5%">Tempat Lahir</th>
                <th width="10%">Tanggal Lahir</th>
                <th width="20%">Alamat</th>
                <th width="5%">Status</th>
                <th width="5%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudpengajar');
          $query = $this->mcrudpengajar->selectpengajar();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row->nip ?></td>
                <td><?php echo $row->nama ?></td>
                <td><?php echo $row->jenis_kelamin?></td>
                <td><?php echo $row->tempat_lahir ?></td>
                <td><?php echo $row->tgl_lahir ?></td>
                <td><?php echo $row->alamat ?></td>
                <td><?php echo $row->status_nama ?></td>
                <td>
                  <button onclick="EditPengajar(<?=$row->pengajar_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelPengajar(<?=$row->pengajar_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addpengajar(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH PENGAJAR</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddPengajar",
       "name" => "FrmAddPengajar"
   );
   echo form_open('cpage/pengajar',$frmattributes);
  ?>

  <div class="modal-body">

    <div class="box-body">
      <div class="form-group">
        <label for="nik">NIP</label>
        <input type="text" class="form-control" id="id_nip" name="id_nip" placeholder="Ketik NIM" required>
        <label for="id_nip" class="error"></label>
      </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_nama" name="id_nama" placeholder="Ketik Nama" required>
      <label for="id_nama" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">jenis Kelamin</label>
          <select id="id_jk" name="id_jk" class="form-control" data-toggle="dropdown" title="Nothing selected">
            <option value=" " >--Pilih Jenis Kelamin-- </option>
            <option value="Laki-laki" >Laki-laki </option>
            <option value="Perempuan" >Perempuan</option>
          </select>
        <label for="id_jk" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tempat Lahir</label>
          <input type="text" class="form-control" id="id_tel" name="id_tel" placeholder="Tempat Lahir" required>
        <label for="id_tel" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Lahir</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tam" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tam" required>
      <label for="id_tam" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Alamat</label>
        <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" required></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="col-sm-5">
      <label for="status">Status</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="2">
                          <label for="id_status2">
                            Block
                          </label>
                        </div>

  </div>
        <div class="modal-footer">
         <button id="id_pengajarbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditpengajar(){
  $this->load->model('mcrudpengajar');
  $query=$this->mcrudpengajar->selecteditpengajar();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT PENGAJAR</h4>
  </div>
  <div class="modal-body">

      <div class="form-group">
        <label for="nik">NIP</label>
        <input type="text" class="form-control" id="id_nip" name="id_nip" placeholder="Ketik NIM" value="<?=$row->nip?>" required>
        <label for="id_nip" class="error"></label>
      </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_nama" placeholder="Ketik Nama" value="<?=$row->nama?>" required>
      <label for="id_nama" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">jenis Kelamin</label>
          <select id="id_jk" name="id_jk" class="form-control">
            <option selected="selected"><?=$row->jenis_kelamin?></option>
            <option value="laki-laki" >laki-laki </option>
            <option value="perempuan" >Perempuan</option>
          </select>
        <label for="id_jk" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tempat Lahir</label>
          <input type="text" class="form-control" id="id_tel" name="id_tel" placeholder="Tempat Lahir" value="<?=$row->tempat_lahir?>" required>
        <label for="id_tel" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Lahir</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tam" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tam" value="<?=$row->tgl_lahir?>" required>
      <label for="id_tam" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Alamat</label>
        <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" value="" required><?=$row->alamat?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
        <select id="id_status" name="id_status" class="form-control">
          <option selected="selected"><?=$row->status_id?></option>
          <option value="1" >Aktif </option>
          <option value="2" >Blocking</option>
        </select>
      <label for="id_status" class="error"></label>
    </div>
 </div>
</div>
</div>

  <div class="modal-footer">
     <button id="id_pengajar1" type="button" class="btn btn-primary" onclick="Updpengajar()">Save changes</button>
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

  public function savepengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->insertpengajar();
}

 public function Editpengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->editpengajar();
}

  public function DelPengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->deletepengajar();


}
}
?>

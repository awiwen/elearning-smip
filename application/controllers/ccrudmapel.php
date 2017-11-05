<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmapel extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmapel(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Nama Matapelajaran</th>
                <th width="10%">Info</th>
                <th width="5%">Status</th>
                <th width="5%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudmapel');
      $query = $this->mcrudmapel->selectmapel();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row->nama_mapel ?></td>
                <td><?php echo $row->info?></td>
                <td><?php echo $row->status_nama?></td>
                <td>
                  <button onclick="EditMapel(<?=$row->mapel_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelMapel(<?=$row->mapel_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addmapel(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH MATAPELAJARAN</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddMapel",
       "name" => "FrmAddMapel"
   );
   echo form_open('cpage/manamapel',$frmattributes);
  ?>

  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddMapel",
         "name" => "FrmAddMapel"
     );
     echo form_open('ctrlpage/mapel',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Nama Matapelajaran</label>
      <input type="text" class="form-control" id="id_namamapel" placeholder="Ketik Nama Matapelajaran" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="info">Info Tambahan</label>
        <textarea class="form-control" rows="3" id="id_info" name="id_alamat" placeholder="Ketik Info Tambahan" required></textarea>
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
         <button id="id_mapelbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditmapel(){
  $this->load->model('mcrudmapel');
  $query=$this->mcrudmapel->selecteditmapel();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT MATAPELAJARAN</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="nama">Nama Matapelajaran</label>
      <input type="text" class="form-control" id="id_namamapel" placeholder="Ketik Nama Matapelajaran" value="<?=$row->nama_mapel?>" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="info">Info Tambahan</label>
        <textarea class="form-control" rows="3" id="id_info" name="id_info" placeholder="Ketik Info Tambahan" value="" required><?=$row->info?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
        <select id="id_status" name="id_status" class="form-control">
          <option selected="selected"><?=$row->status_id?></option>
          <option value="akt" >aktif </option>
          <option value="bl" >Blocking</option>
        </select>
      <label for="id_status" class="error"></label>
    </div>
 </div>
</div>
</div>

  <div class="modal-footer">
     <button id="id_mapel1" type="button" class="btn btn-primary" onclick="Updmapel()">Save changes</button>
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

  public function savemapel(){

  $this->load->model('mcrudmapel');
  $query = $this->mcrudmapel->insertmapel();
}

 public function Editmapel(){
  $this->load->model('mcrudmapel');
  $query = $this->mcrudmapel->editmapel();
}

  public function Delmapel(){
  $this->load->model('mcrudmapel');
  $query = $this->mcrudmapel->deletemapel();


}
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmapel_kelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmapel_kelas(){
  ?>
  <div class="col-lg">
    <?php
    $this->load->model('mcrudkelas');
    $query = $this->mcrudkelas->selectParent();

    $i = 1;
    foreach($query->result() as $row){
      ?>
    <div class="panel panel-default">
      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div>
      <div class="panel-body">

        <div class="col-lg">
          <?php
          $query = $this->mcrudkelas->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){
            ?>
          <div class="panel panel-default">
            <div class="panel-heading"> <h4> <?php echo $kelas->nama_kelas;?> </div>
            <div class="panel-body">


              <div class="panel-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Matapelajaran</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
              $this->load->model('mcrudmapel_kelas');
                  $query = $this->mcrudmapel_kelas->showmapel_kelas($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $row){
                ?>
                      <tr>
                        <td><?php echo $row->nama_mapel ?></td>
                        <td>
                          <button onclick="EditKelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                          <button onclick="Delkelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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
    <?php
    }
    ?>
  </div>

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

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddMapel_kelas",
         "name" => "FrmAddMapel_kelas"
     );
     echo form_open('ctrlpage/mapel_kelas',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Nama mapel_kelas</label>
      <input type="text" class="form-control" id="id_namamapel_kelas" placeholder="Ketik Nama" required>
      <label for="id_namamapel_kelas" class="error"></label>
    </div>

    <div class="form-group">
       <label for="jkel">Parent</label>
         <select id="id_parent" name="id_parent" class="form-control">
           <option value="X" >X </option>
           <option value="XI" >XI </option>
           <option value="XII" >XII </option>

         </select>
       <label for="id_jkel" class="error"></label>
   </div>

    <div class="col-sm-5">
      <label for="status">Status</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="Aktif" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="Block">
                          <label for="id_status2">
                            Block
                          </label>
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

public function showeditmapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query=$this->mcrudmapel_kelas->selecteditmapel_kelas();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH mapel_kelas</h4>
  </div>
  <div class="modal-body">

    <div class="box-body">
       <div class="form-group">
         <label for="id">ID List</label>
         <input type="text" class="form-control" id="id_mapel_kelas" placeholder="Ketik Id" value="<?=$row->id?>" readonly="readonly">
        </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_namamapel_kelas" placeholder="Ketik Nama" value="<?=$row->nama_mapel_kelas?>" required>
      <label for="id_namamapel_kelas" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">jenis Kelamin</label>
          <select id="id_parent" name="id_parent" class="form-control">
            <option selected="selected"><?=$row->parent_id?></option>
            <option value="X" >X </option>
            <option value="XI" >XI </option>
            <option value="XII" >XII </option>
          </select>
        <label for="id_parent" class="error"></label>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
        <select id="id_status" name="id_status" class="form-control">
          <option selected="selected"><?=$row->status_id?></option>
          <option value="Aktif" >Aktif </option>
          <option value="Blocking" >Blocking</option>
        </select>
      <label for="id_status" class="error"></label>
    </div>
 </div>
</div>
</div>

  <div class="modal-footer">
     <button id="id_mapel_kelas1" type="button" class="btn btn-primary" onclick="Updmapel_kelas()">Save changes</button>
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

  public function Savemapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->insertmapel_kelas();
}

 public function EditMapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->editmapel_kelas();
}

  public function DelMapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->deletemapel_kelas();


}
}
?>

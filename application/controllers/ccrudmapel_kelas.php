<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmapel_kelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmapel_kelas(){
  ?>

  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">mapel_kelas X</div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="10%">Mata Pelajaran</th>
              <th width="5%">Opsi</th>
            </tr>
          </thead>

      <?php
      $this->load->model('mcrudmapel_kelas');
          $query = $this->mcrudmapel_kelas->selectmapel_kelasparentx();
      $i = 1;
      foreach($query->result() as $row){
      ?>

      <tr>

                <td><?php echo $row->mapel_id ?></td>
                <td>
                  <button onclick="Editmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="Delmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">mapel_kelas XI</div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="10%">Nama mapel_kelas</th>
              <th width="5%">Status</th>
              <th width="5%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcrudmapel_kelas');
          $query = $this->mcrudmapel_kelas->selectmapel_kelasparentxi();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>

                <td><?php echo $row->nama_mapel_kelas ?></td>
                <td><?php echo $row->status_id ?></td>
                <td>
                  <button onclick="Editmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="Delmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">mapel_kelas XII</div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="10%">Nama mapel_kelas</th>
              <th width="5%">Status</th>
              <th width="5%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcrudmapel_kelas');
          $query = $this->mcrudmapel_kelas->selectmapel_kelasparentxii();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>

                <td><?php echo $row->nama_mapel_kelas ?></td>
                <td><?php echo $row->status_id ?></td>
                <td>
                  <button onclick="Editmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="Delmapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function addmapel_kelas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH mapel_kelas</h4>
  </div>
  <div class="modal-body">

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
      <input type="text" class="form-control" id="id_namamapel_kelas" placeholder="Ketik Nama" value="<?=$row->nama?>" required>
      <label for="id_namakelas" class="error"></label>
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

 public function Editmapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->editmapel_kelas();
}

  public function Delmapel_kelas(){
  $this->load->model('mcrudmapel_kelas');
  $query = $this->mcrudmapel_kelas->deletemapel_kelas();


}
}
?>

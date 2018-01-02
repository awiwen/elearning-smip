<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudkelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showkelas(){
  ?>

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"> <h4> Kelas X </h4></div>
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">Nama Kelas</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcrudkelas');
          $query = $this->mcrudkelas->selectkelasparentx();
      $i = 1;
      foreach($query->result() as $row){
        ?>
              <tr>
                <td><?php echo $row->nama_kelas ?></td>
                <td>
                  <button onclick="EditKelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="Delkelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Kelas XI</div>

      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">Nama Kelas</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcrudkelas');
          $query = $this->mcrudkelas->selectkelasparentxi();
      $i = 1;
      foreach($query->result() as $row){
        ?>
          <tr>
            <td><?php echo $row->nama_kelas ?></td>
            <td>
              <button onclick="EditKelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
              <button onclick="Delkelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Kelas XII</div>
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">Nama Kelas</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcrudkelas');
          $query = $this->mcrudkelas->selectkelasparentxii();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
        <td><?php echo $row->nama_kelas ?></td>
        <td>
          <button onclick="EditKelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
          <button onclick="Delkelas(<?=$row->kelas_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function addkelas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH Kelas</h4>
  </div>

  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddKelas",
         "name" => "FrmAddKelas"
     );
     echo form_open('ctrlpage/kelas',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Nama Kelas</label>
      <input type="text" class="form-control" id="id_namakelas" placeholder="Ketik Nama" required>
      <label for="id_namakelas" class="error"></label>
    </div>

    <div class="form-group">
       <label for="jkel">Parent</label>
         <select id="id_parent" name="id_parent" class="form-control">
           <option value="1" >X </option>
           <option value="6" >XI </option>
           <option value="11" >XII </option>

         </select>
       <label for="id_jkel" class="error"></label>
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

public function showeditkelas(){
  $this->load->model('mcrudkelas');
  $query=$this->mcrudkelas->selecteditkelas();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT KELAS</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID List</label>
      <input type="text" class="form-control" id="id_kelas" placeholder="Ketik Id" value="<?=$row->kelas_id?>" readonly="readonly">
     </div>

    <div class="form-group">
      <label for="nama">Nama Kelas</label>
      <input type="text" class="form-control" id="id_namakelas" placeholder="Ketik Nama kelas" value="<?=$row->nama_kelas?>" required>
      <label for="id_namakelas" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">Parent Kelas(1:X,6:XI,11:XII)</label>
          <select id="id_parent" name="id_parent" class="form-control">
            <option selected="selected"><?=$row->parent_id?></option>
            <option value="1" >X </option>
            <option value="6" >XI </option>
            <option value="11" >XII </option>
          </select>
        <label for="id_parent" class="error"></label>
    </div>


 </div>
</div>
</div>

  <div class="modal-footer">
     <button id="id_kelas1" type="button" class="btn btn-primary" onclick="Updkelas()">Save changes</button>
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

  public function Savekelas(){
  $this->load->model('mcrudkelas');
  $query = $this->mcrudkelas->insertkelas();
}

 public function EditKelas(){
  $this->load->model('mcrudkelas');
  $query = $this->mcrudkelas->editkelas();
}

  public function Delkelas(){
  $this->load->model('mcrudkelas');
  $query = $this->mcrudkelas->deletekelas();


}
}
?>

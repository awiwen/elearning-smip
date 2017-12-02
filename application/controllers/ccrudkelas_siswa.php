<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudkelas_siswa extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showkelas_siswa(){
  ?>
  <div class="panel panel-default">
  <div class="panel-body">
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
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="10%">NIS</th>
                      <th width="30%">Nama Siswa</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
              $this->load->model('mcrudkelas_siswa');
                  $query = $this->mcrudkelas_siswa->showkelas_siswa($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $row){
                ?>
                      <tr>
                        <td><?php echo $row->nis ?></td>
                        <td><?php echo $row->nama ?></td>
                        <td>
                          <button onclick="EditKelas_siswa(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                          <button onclick="DelKelas_siswa(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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
  </div>
  </div>

  <?php
}

public function addkelas_siswa(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH MATAPELAJARAN KELAS</h4>
  </div>



  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddKelas_siswa",
         "name" => "FrmAddKelas_siswa"
     );
     echo form_open('ctrlpage/kelas_siswa',$frmattributes);
    ?>

    <div class="form-group">
              <label for="mapel">Kelas</label>
              <select id="id_kelas" class="form-control" class=”required” name="id_kelas" required>
              <label for="id_kelas" class="error"></label>
        <option value=''>---- PILIH KELAS ----</option>
        <?php
          $this->load->model('mcrudkelas_siswa');
          $query = $this->mcrudkelas_siswa->selectkelas();
          foreach($query->result() as $row){
        ?>
        <option value="<?=$row->kelas_id?>"><?=$row->nama_kelas?></option>
        <?php
        }
        ?>
        </select>
    </div>

    <div class="form-group">
              <label for="mapel">Siswa</label>
              <select id="id_siswa" class="form-control" class=”required” name="id_siswa" required>
              <label for="id_siswa" class="error"></label>
                    <option value=''>---- PILIH SISWA ----</option>
                     <?php
                    $this->load->model('mcrudkelas_siswa');
                $query = $this->mcrudkelas_siswa->selectsiswa();
            foreach($query->result() as $row){
            ?>
            <option value="<?=$row->siswa_id?>">NIM : <?=$row->nis?> &emsp; NAMA : <?=$row->nama?></option>
            <?php
          }
          ?>
              </select>
            </div>

        <div class="modal-footer">
         <button id="id_kelas_siswabtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditkelas_siswa(){
  $this->load->model('mcrudkelas_siswa');
  $query=$this->mcrudkelas_siswa->selecteditkelas_siswa();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT SISWA KELAS</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID List</label>
      <input type="text" class="form-control" id="id_kelassiswa" placeholder="Ketik Id" value="<?=$row->id?>" readonly="readonly">
     </div>

     <div class="form-group">
               <label for="mapel">Kelas</label>
               <select id="id_kelas" class="form-control" name="id_kelas" required>
               <label for="id_kelas" class="error"></label>
               <?php
               $this->load->model('mcrudmapel_kelas');
               $query = $this->mcrudmapel_kelas->selectkelas();
               foreach($query->result() as $row){
                 $select = '';
                 if($row->kelas_id == $mapel->kelas_id){
                   $select = 'selected';
                 }
               ?>
               <option value="<?=$row->kelas_id?>" <?= $select ?>><?=$row->nama_kelas?></option>
               <?php
               }
               ?>
               </select>
     </div>

     <div class="form-group">
               <label for="mapel">Siswa</label>
               <select id="id_siswa" class="form-control" name="id_siswa" required>
               <label for="id_siswa" class="error"></label>
               <?php
               $this->load->model('mcrudkelas_siswa');
               $query = $this->mcrudkelas_siswa->selectsiswa();
               foreach($query->result() as $row){
                 $select = '';
                 if($row->kelas_id == $siswa->kelas_id){
                   $select = 'selected';
                 }
               ?>
               <option value="<?=$row->siswa_id?>" <?= $select ?>> NIS : <?=$row->nis?> NAMA : <?=$row->nama?></option>
               <?php
               }
               ?>
               </select>
     </div>




 </div>
</div>

  <div class="modal-footer">
     <button id="id_kelas_siswa1" type="button" class="btn btn-primary" onclick="Updkelas_siswa()">Save changes</button>
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

  public function SaveKelas_siswa(){
  $this->load->model('mcrudkelas_siswa');
  $query = $this->mcrudkelas_siswa->insertkelas_siswa();
}

 public function EditKelas_siswa(){
  $this->load->model('mcrudkelas_siswa');
  $query = $this->mcrudkelas_siswa->editkelas_siswa();
}

  public function DelKelas_siswa(){
  $this->load->model('mcrudkelas_siswa');
  $query = $this->mcrudkelas_siswa->deletekelas_siswa();


}
}
?>

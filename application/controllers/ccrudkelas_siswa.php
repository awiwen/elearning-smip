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
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Matapelajaran</th>
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
                        <td><?php echo $row->nama_mapel ?></td>
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
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required>
              <label for="id_mapel" class="error"></label>
                    <option>---- PILIH MATAPELAJARAN ----</option>
                     <?php
                    $this->load->model('mcrudkelas_siswa');
       		  		$query = $this->mcrudkelas_siswa->selectmapel();
			  		foreach($query->result() as $row){
						?>
						<option value="<?=$row->mapel_id?>"><?=$row->nama_mapel?></option>
						<?php
					}
					?>
              </select>
            </div>

    <div class="form-group">
      <label for="kelas">Kelas</label>
      <select id="id_kelas" class="form-control" name="id_kelas" required>
      <label for="id_kelas" class="error"></label>
        <option>---- PILIH KELAS ----</option>
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
          <h4 class="modal-title">EDIT MATAPELAJARAN KELAS</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID List</label>
      <input type="text" class="form-control" id="id_mapelkelas" placeholder="Ketik Id" value="<?=$row->id?>" readonly="readonly">
     </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudkelas_siswa');
              $query = $this->mcrudkelas_siswa->selectmapel();
              foreach($query->result() as $row){
              ?>
              <option selected="selected"><?=$row->nama_mapel?></option>
              <option value="<?=$row->mapel_id?>"><?=$row->nama_mapel?></option>
              <?php
              }
              ?>
              </select>
    </div>

    <div class="form-group">
              <label for="mapel">Kelas</label>
              <select id="id_kelas" class="form-control" name="id_kelas" required>
              <label for="id_kelas" class="error"></label>
              <?php
              $this->load->model('mcrudkelas_siswa');
              $query = $this->mcrudkelas_siswa->selectkelas();
              foreach($query->result() as $row){
              ?>
              <option selected="selected"><?=$row->nama_kelas?></option>
              <option value="<?=$row->kelas_id?>"><?=$row->nama_kelas?></option>
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

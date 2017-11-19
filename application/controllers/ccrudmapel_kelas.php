<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmapel_kelas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmapel_kelas(){
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
              $this->load->model('mcrudmapel_kelas');
                  $query = $this->mcrudmapel_kelas->showmapel_kelas($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $row){
                ?>
                      <tr>
                        <td><?php echo $row->nama_mapel ?></td>
                        <td>
                          <button onclick="EditMapel_kelas(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
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

public function addmapel_kelas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH MATAPELAJARAN KELAS</h4>
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
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" class=”required” name="id_mapel" required>
              <label for="id_mapel" class="error"></label>
                    <option>---- PILIH MATAPELAJARAN ----</option>
                     <?php
                    $this->load->model('mcrudmapel_kelas');
       		  		$query = $this->mcrudmapel_kelas->selectmapel();
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
      <select id="id_kelas" class="form-control" class=”required” name="id_kelas" required>
      <label for="id_kelas" class="error"></label>
        <option>---- PILIH KELAS ----</option>
        <?php
          $this->load->model('mcrudmapel_kelas');
          $query = $this->mcrudmapel_kelas->selectkelas();
          foreach($query->result() as $row){
        ?>
        <option value="<?=$row->kelas_id?>"><?=$row->nama_kelas?></option>
        <?php
        }
        ?>
        </select>
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
  foreach($query->result() as $mapel){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT MATAPELAJARAN KELAS</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID List</label>
      <input type="text" class="form-control" id="id_mapelkelas" placeholder="Ketik Id" value="<?=$mapel->id?>" readonly="readonly">
     </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudmapel_kelas');
              $query = $this->mcrudmapel_kelas->selectmapel();
              foreach($query->result() as $row){
                $select = '';
                if($row->mapel_id == $mapel->mapel_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->mapel_id?>" <?= $select ?>><?=$row->nama_mapel?></option>
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

  public function SaveMapel_kelas(){
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

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudkomen_materi extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showkomen_materi(){
  ?>
<!--
  <div class="panel-body">
  <div class="col-lg">
    <?php
    $this->load->model('mcrudkelas');
    $query = $this->mcrudkelas->selectParent();

    $i = 1;
    foreach($query->result() as $row){
      ?>
    <div class="panel panel-default">

      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div> -->


      <div class="panel-body">
        <div class="col-lg">

          <?php
          $this->load->model('mcrudkomen_materi');
          $query = $this->mcrudkomen_materi->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){
            ?>
          <div class="panel panel-default">
            <div class="panel-heading" style="display: block;"> <h4> <?php echo $kelas->nama_kelas;?> </div>
            <div class="panel-body">

              <?php
              $this->load->model('mcrudkomen_materi');
                $haris = $this->mcrudkomen_materi->showhari($kelas->kelas_id);
              $i = 1;
              foreach($haris->result() as $hari){
                ?>
              <div style="font-size:15px"> <b> <?php echo $hari->hari_nama;?> </b> </div>

            <div style="font-size:20px"> </div >
              <div class="panel-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="10%">Jam Mulai</th>
                      <th width="10%">Jam Selesai</th>
                      <th width="10%">Pengajar</th>
                      <th width="10%">Matapelajaran</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
              <?php
              $this->load->model('mcrudkomen_materi');
                  $query = $this->mcrudkomen_materi->showmapel_ajar($hari->hari_id,$kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $row){
              ?>
                      <tr>
                        <td><?php echo $row->jam_mulai?></td>
                        <td><?php echo $row->jam_selesai?></td>
                        <td><?php echo $row->nama?></td>
                        <td><?php echo $row->nama_mapel?></td>
                        <td>
                          <button onclick="Editkomen_materi(<?=$row->mapel_ajar_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                          <button onclick="Delkomen_materi(<?=$row->mapel_ajar_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                        </td>
                      </tr>
              <?php
              $i++;
              }
              ?>
                </table>
              </div>



            <?php
            }
            ?>

            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    <!-- </div>
    <?php
    }
    ?>
  </div>
  </div>
   -->

  <?php
}

public function addkomen_materi(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH JADWAL</h4>
  </div>

  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddKomen_materi",
         "name" => "id_FrmAddKomen_materi"
     );
     echo form_open('ctrlpage/vkomen_materi',$frmattributes);
    ?>
    <table>
    <tr>
      <th>
    <div class="form-group">
              <label for="mapel">HARI</label><br>
              <select id="id_hari" class="btn dropdown-toggle btn-default" class="required" name="id_hari" required>
              <label for="id_hari" class="error"></label>
                    <option value=''>---- PILIH HARI ----</option>
                     <?php
                    $this->load->model('mcrudkomen_materi');
       		  		$query = $this->mcrudkomen_materi->selecthari();
			  		foreach($query->result() as $row){
						?>
						<option value="<?=$row->hari_id?>"><?=$row->hari_nama?></option>
						<?php
					}
					?>
              </select>
            </div>
</th>
<th width="10%">
</th>
<th>

</th>
</tr>
<tr>
  <th>

    <div class="form-group">
      <label for="kelas">Matapelajaran Kelas</label><br>
      <select id="id_mapel_kelas" class="btn dropdown-toggle btn-default" class=”required” name="id_mapel_kelas" required>
      <label for="id_mapel_kelas" class="error"></label>
        <option value=''>---- PILIH MATAPELAJARAN KELAS ----</option>
        <?php
          $this->load->model('mcrudkomen_materi');
          $query = $this->mcrudkomen_materi->selectmapel_kelas();
          foreach($query->result() as $row){
        ?>
        <option value="<?=$row->id?>"><?=$row->nama_kelas?> <?=$row->nama_mapel?></option>
        <?php
        }
        ?>
        </select>
    </div>

          </th>
          <th width="10%">
          </th>

          <th>
      <div class="form-group">
        <label for="pengajar">Pengajar</label><br>
          <select id="id_pengajar" class="btn dropdown-toggle btn-default" class=”required”  name="id_pengajar" required>
            <label for="id_pengajar" class="error"></label>
        <option value=''>---- PILIH PENGAJAR ----</option>
       <?php
          $this->load->model('mcrudkomen_materi');
          $query = $this->mcrudkomen_materi->selectpengajar();
        foreach($query->result() as $row){
        ?>
        <option value="<?=$row->pengajar_id?>"><?=$row->nama?></option>
        <?php
        }
        ?>
        </select>
    </div>
  </th>
</tr>

<tr>
  <th>
    <div class="form-group">
      <label for="kelas">Jam Mulai</label><br>
      <input type="text" id="id_jmulai" name="id_jmulai" data-format="HH:mm" placeholder="HH:MM" class="input-small">
    </div>
  </th>
  <th width="10%">
  </th>
  <th>
    <div class="form-group">
      <label for="kelas">Jam Selesai</label><br>
      <input type="text" id="id_jselesai" name="id_jselesai" data-format="HH:mm" placeholder="HH:MM" class="input-small">
    </div>
  </th>
</tr>
<tr>
  <th width="10%">
  </th>
  <th width="10%">
  </th>
    <th>
        <div class="modal-footer">
         <button id="id_komen_materibtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
      </th>
    </tr>
  </table>

  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditkomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query=$this->mcrudkomen_materi->selecteditmapel_ajar();
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
      <input type="text" class="form-control" id="id_mapel_ajar" placeholder="Ketik Id" value="<?=$mapel->mapel_ajar_id?>" readonly="readonly">
     </div>

     <table>
     <tr>
       <th>

     <div class="form-group">
               <label for="mapel">HARI</label><br>
               <select id="id_hari" class="btn dropdown-toggle btn-default" class="required" name="id_hari" required>
               <label for="id_hari" class="error"></label>
                      <?php
                     $this->load->model('mcrudkomen_materi');
        		  		$query = $this->mcrudkomen_materi->selecthari();
 			  		foreach($query->result() as $row){
              $select = '';
              if($row->hari_id == $mapel->hari_id){
                $select = 'selected';
              }
 						?>
 						<option value="<?=$row->hari_id?>"><?=$row->hari_nama?></option>
 						<?php
 					}
 					?>
               </select>
             </div>
 </th>
 <th width="10%">
 </th>
 <th>

 </th>
 </tr>
 <tr>
   <th>

     <div class="form-group">
       <label for="kelas">Matapelajaran Kelas</label><br>
       <select id="id_mapel_kelas" class="btn dropdown-toggle btn-default" class=”required” name="id_mapel_kelas" required>
       <label for="id_mapel_kelas" class="error"></label>
         <?php
           $this->load->model('mcrudkomen_materi');
           $query = $this->mcrudkomen_materi->selectmapel_kelas();
           foreach($query->result() as $row){
             $select = '';
             if($row->id == $mapel->id){
               $select = 'selected';
             }
         ?>
         <option value="<?=$row->id?>"><?=$row->nama_kelas?> <?=$row->nama_mapel?></option>
         <?php
         }
         ?>
         </select>
     </div>

           </th>
           <th width="10%">
           </th>
           <th>
       <div class="form-group">
         <label for="pengajar">Pengajar</label><br>
           <select id="id_pengajar" class="btn dropdown-toggle btn-default" name="id_pengajar" required>
             <label for="id_pengajar" class="error"></label>
        <?php
           $this->load->model('mcrudkomen_materi');
           $query = $this->mcrudkomen_materi->selectpengajar();
         foreach($query->result() as $row){
           $select = '';
           if($row->pengajar_id == $mapel->pengajar_id){
             $select = 'selected';
           }
         ?>
         <option value="<?=$row->pengajar_id?>"><?=$row->nama?></option>
         <?php
         }
         ?>
         </select>
     </div>
   </th>
 </tr>

 <tr>
   <th>
     <div class="form-group">
       <label for="kelas">Jam Mulai</label><br>
       <input type="text" id="id_jmulai" name="id_jmulai" data-format="HH:mm" value="<?=$mapel->jam_mulai?>" class="input-small">
     </div>
   </th>
   <th width="10%">
   </th>
   <th>
     <div class="form-group">
       <label for="kelas">Jam Selesai</label><br>
       <input type="text" id="id_jselesai" name="id_jselesai" data-format="HH:mm" value="<?=$mapel->jam_selesai?>" class="input-small">
     </div>
   </th>
 </tr>
 <tr>
   <th width="10%">
   </th>
   <th width="10%">
   </th>
     <th>
         <div class="modal-footer">
          <button id="id_mapel_kelas1" type="button" class="btn btn-primary" onclick="UpdKomen_materi()">Save changes</button>
         </div>
       </th>
     </tr>
   </table>


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

  public function Savekomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query = $this->mcrudkomen_materi->insertkomen_materi();
}

 public function EditKomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query = $this->mcrudkomen_materi->editkomen_materi();
}

  public function DelKomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query = $this->mcrudkomen_materi->deletekomen_materi();


}
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccruddashboard_p extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showdashboard(){
  ?>
  <div class="panel-body">
  <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th width="15%">Hari</th>
        <th width="15%">jam_mulai</th>
        <th width="15%">jam_selesai</th>
        <th width="5%">Matapelajaran</th>
        <!-- <th width="20%">Pengajar</th> -->
        <th width="15%">Kelas</th>
      </tr>
    </thead>
    <?php
    $this->load->model('mcruddashboard');
        $query = $this->mcruddashboard->showtugascari_p($this->session->userdata('pengajar_id'));
    $i = 1;
    foreach($query->result() as $jawaban){
      ?>
        <tr>
          <!-- <td><?php echo $i ?></td>. -->
          <td><?php echo $jawaban->hari_nama?></td>
          <td><?php echo $jawaban->jam_mulai?></td>
          <td><?php echo $jawaban->jam_selesai?></td>
          <td><?php echo $jawaban->nama_mapel?></td>
          <!-- <td><?php echo $jawaban->nama?></td> -->
          <td><?php echo $jawaban->nama_kelas?></td>
        </tr>
<?php
$i++;
}
?>
  </table>
  </div>

  <?php
}

public function adddashboard(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH JADWAL</h4>
  </div>

  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddDashboard",
         "name" => "id_FrmAddDashboard"
     );
     echo form_open('ctrlpage/dashboard',$frmattributes);
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
                    $this->load->model('mcruddashboard_p');
       		  		$query = $this->mcruddashboard_p->selecthari();
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
          $this->load->model('mcruddashboard_p');
          $query = $this->mcruddashboard_p->selectmapel_kelas();
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
          $this->load->model('mcruddashboard_p');
          $query = $this->mcruddashboard_p->selectpengajar();
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
      <input type="text" id="id_jmulai" name="id_jmulai" data-format="HH:mm" placeholder="HH:MM" class="input-small" required>
    </div>
  </th>
  <th width="10%">
  </th>
  <th>
    <div class="form-group">
      <label for="kelas">Jam Selesai</label><br>
      <input type="text" id="id_jselesai" name="id_jselesai" data-format="HH:mm" placeholder="HH:MM" class="input-small" required>
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
         <button id="id_dashboardbtn" type="button" class="btn btn-primary">Simpan</button>
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

public function showeditdashboard(){
  $this->load->model('mcruddashboard_p');
  $query=$this->mcruddashboard_p->selecteditmapel_ajar();
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
                     $this->load->model('mcruddashboard_p');
        		  		$query = $this->mcruddashboard_p->selecthari();
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
           $this->load->model('mcruddashboard_p');
           $query = $this->mcruddashboard_p->selectmapel_kelas();
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
           $this->load->model('mcruddashboard_p');
           $query = $this->mcruddashboard_p->selectpengajar();
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
          <button id="id_mapel_kelas1" type="button" class="btn btn-primary" onclick="UpdDashboard()">Save changes</button>
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

  public function Savedashboard(){
  $this->load->model('mcruddashboard_p');
  $query = $this->mcruddashboard_p->insertdashboard();
}

 public function EditDashboard(){
  $this->load->model('mcruddashboard_p');
  $query = $this->mcruddashboard_p->editdashboard();
}

  public function DelDashboard(){
  $this->load->model('mcruddashboard_p');
  $query = $this->mcruddashboard_p->deletedashboard();


}
}
?>

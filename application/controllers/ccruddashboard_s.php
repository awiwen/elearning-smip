<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccruddashboard_p extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showdashboard(){
  ?>
  <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-body bk-primary text-light">
                    <div class="stat-panel text-center">
                      <div class="stat-panel-number h1 ">24</div>
                      <div class="stat-panel-title text-uppercase">Pengumuman Baru</div>
                    </div>
                  </div>
                  <a href="#" class="block-anchor panel-footer">Tampilkan Semua <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-body bk-success text-light">
                    <div class="stat-panel text-center">
                      <div class="stat-panel-number h1 ">8</div>
                      <div class="stat-panel-title text-uppercase">Tugas Baru</div>
                    </div>
                  </div>
                  <a href="#" class="block-anchor panel-footer text-center">Tampilkan Semua &nbsp; <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-body bk-info text-light">
                    <div class="stat-panel text-center">
                      <div class="stat-panel-number h1 ">58</div>
                      <div class="stat-panel-title text-uppercase">Materi Baru</div>
                    </div>
                  </div>
                  <a href="#" class="block-anchor panel-footer text-center">Tampilkan Semua &nbsp; <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-body bk-warning text-light">
                    <div class="stat-panel text-center">
                      <div class="stat-panel-number h1 ">18</div>
                      <div class="stat-panel-title text-uppercase">Komentar Baru</div>
                    </div>
                  </div>
                  <a href="#" class="block-anchor panel-footer text-center">Tampilkan Semua &nbsp; <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <div class="panel-body">
        <div class="col-lg">

          <?php
          $this->load->model('mcruddashboard');
          $query = $this->mcruddashboard->selectkelas($this->session->userdata('siswa_id'));

          $i = 1;
          foreach($query->result() as $kelas){
            ?>
          <div class="panel panel-default">
            <div class="panel-heading" style="display: block;"> <h4> <?php echo $kelas->nama_kelas;?> </div>
            <div class="panel-body">

              <?php
              $this->load->model('mcruddashboard');
                $haris = $this->mcruddashboard->showhari($kelas->kelas_id);
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
                    </tr>
                  </thead>
              <?php
              $this->load->model('mcruddashboard');
                  $query = $this->mcruddashboard->showmapel_ajar($hari->hari_id,$kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $row){
              ?>
                      <tr>
                        <td><?php echo $row->jam_mulai?></td>
                        <td><?php echo $row->jam_selesai?></td>
                        <td><?php echo $row->nama?></td>
                        <td><?php echo $row->nama_mapel?></td>

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
                    $this->load->model('mcruddashboard');
       		  		$query = $this->mcruddashboard->selecthari();
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
          $this->load->model('mcruddashboard');
          $query = $this->mcruddashboard->selectmapel_kelas();
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
          $this->load->model('mcruddashboard');
          $query = $this->mcruddashboard->selectpengajar();
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
  $this->load->model('mcruddashboard');
  $query=$this->mcruddashboard->selecteditmapel_ajar();
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
                     $this->load->model('mcruddashboard');
        		  		$query = $this->mcruddashboard->selecthari();
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
           $this->load->model('mcruddashboard');
           $query = $this->mcruddashboard->selectmapel_kelas();
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
           $this->load->model('mcruddashboard');
           $query = $this->mcruddashboard->selectpengajar();
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
  $this->load->model('mcruddashboard');
  $query = $this->mcruddashboard->insertdashboard();
}

 public function EditDashboard(){
  $this->load->model('mcruddashboard');
  $query = $this->mcruddashboard->editdashboard();
}

  public function DelDashboard(){
  $this->load->model('mcruddashboard');
  $query = $this->mcruddashboard->deletedashboard();


}
}
?>

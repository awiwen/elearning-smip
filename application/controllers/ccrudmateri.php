<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmateri extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmateri(){
  ?>
  <div class="col-lg">
    <?php
    $this->load->model('mcrudmateri');
    $query = $this->mcrudmateri->selectParent();

    $i = 1;
    foreach($query->result() as $row){

      ?>
    <div class="panel panel-default">

      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div> <!-- KELAS X -->
      <div class="panel-body">

        <div class="col-lg">
          <?php
          $query = $this->mcrudmateri->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){

            ?>

          <div class="panel panel-default">
            <div class="panel-heading"> <h4> <?php echo $kelas->nama_kelas;?> </div> <!-- KELAS X TKJ-->
            <div class="panel-body">

              <?php
              $this->load->model('mcrudmateri');
                $query = $this->mcrudmateri->showmapel($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $mapel){
                ?>

              <div class="panel panel-default"> <!-- MAPEL -->
                <div class="panel-heading"> <h4> <?php echo $mapel->nama_mapel;?> </div> <!-- MAPEL -->
                <div class="panel-body">

              <div class="panel-body"> <!-- MATERI-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Materi</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudmateri');
                      $query = $this->mcrudmateri->showmateri($mapel->mapel_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->judul?></td>
                        <td>
                          <button onclick="DetailMateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="EditMateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                          <button onclick="Delmateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function addmateri(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH MATERI</h4>
  </div>

  <div class="modal-body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddMateri",
         "name" => "FrmAddMateri"
     );
     echo form_open('ctrlpage/materi',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" placeholder="Ketik Judul Materi" required>
      <label for="id_judul" class="error"></label>
    </div>

    <div class="form-group">
      <label for="info">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten" name="id_konten" placeholder="Ketik konten" required></textarea>
      <label for="id_konten" class="error"></label>
    </div>

    <div class="hr-dashed"></div>
    <input id="id_file" name="id_file" type="file" multiple>
    <div id="errorBlock43" class="help-block"></div>
    <div class="hr-dashed"></div>

    <div class="form-group">
      <label for="nik">Tanggal Posting</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tposting" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tposting" required>
      <label for="id_tposting" class="error"></label>
        </div>
    </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required>
              <label for="id_mapel" class="error"></label>
                    <option>---- PILIH MATAPELAJARAN ----</option>
                     <?php
                    $this->load->model('mcrudmateri');
       		  		$query = $this->mcrudmateri->selectmapel();
			  		foreach($query->result() as $row){
						?>
						<option value="<?=$row->mapel_id?>"><?=$row->nama_mapel?></option>
						<?php
					}
					?>
              </select>
            </div>

    <div class="form-group">
        <label for="pengajar">Pengajar</label>
          <select id="id_pengajar" class="form-control" name="id_pengajar" required>
            <label for="id_pengajar" class="error"></label>
        <option>---- PILIH PENGAJAR ----</option>
       <?php
          $this->load->model('mcrudmateri');
    		  $query = $this->mcrudmateri->selectpengajar();
    		foreach($query->result() as $row){
    		?>
        <option value="<?=$row->pengajar_id?>"><?=$row->nama?></option>
        <?php
        }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pengajar">Kelas</label>
          <select id="id_kelas" class="form-control" name="id_kelas" required>
            <label for="id_kelas" class="error"></label>
        <option>---- PILIH KELAS ----</option>
       <?php
          $this->load->model('mcrudmateri');
    		  $query = $this->mcrudmateri->selectkelasadd();
    		foreach($query->result() as $row){
    		?>
        <option value="<?=$row->kelas_id?>"><?=$row->nama_kelas?></option>
        <?php
        }
        ?>
        </select>
    </div>

  </div>
        <div class="modal-footer">
         <button id="id_materibtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showdetailmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selectdetailmateri();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail Materi</h4>
  </div>
  <style>
    #modal_body{
      font-size: 16px;
      font-weight: normal;
    }
  </style>
  <div class="modal-body" id="modal_body">
    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" placeholder="Ketik Nama Matapelajaran" value="<?=$row->judul?>" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="form-control" rows="3" id="id_konten2" name="id_konten" placeholder="Ketik Konten" value="" required><?=strip_tags($row->konten);?></textarea>
      <label for="id_alamat" class="error"></label>
      <a href='<?php echo $path; ?>'>
        <button id='btnDownload' class='submit'>Download</button>
      </a>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Posting</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tposting" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tposting" value="<?=$row->tgl_posting?>"required readonly>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required disabled>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudmateri');
              $query = $this->mcrudmateri->selectmapel();
              foreach($query->result() as $row){
                $select = '';
                if($row->mapel_id == $mapel->mapel_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->mapel_id?>"<?= $select ?>><?=$row->nama_mapel?></option>
              <?php
              }
              ?>
              </select>
    </div>

    <div class="form-group">
              <label for="pengajar">Pengajar</label>
              <select id="id_pengajar" class="form-control" name="id_pengajar" required disabled>
              <label for="id_pengajar" class="error"></label>
              <?php
              $this->load->model('mcrudmateri');
              $query = $this->mcrudmateri->selectpengajar();
              foreach($query->result() as $row){
                $select = '';
                if($row->pengajar_id == $pengajar->pengajar_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->pengajar_id?>" <?= $select ?>><?=$row->nama?></option>
              <?php
              }
              ?>
              </select>
    </div>
    <div class="form-group">
              <label for="mapel">Kelas</label>
              <select id="id_kelas" class="form-control" name="id_kelas" required disabled>
              <label for="id_kelas" class="error"></label>
              <?php
              $this->load->model('mcrudmateri');
              $query = $this->mcrudmateri->selectkelasedit();
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
  <div class="modal-footer">
  <!--   <button id="id_BtnEditMateri" type="button" class="btn btn-primary" onclick="UpdMateri(<?=$row->id?>)">Save changes</button>
  --></div>
  <style>
    .error{
    color: red;
    font-style: italic;
    }
  </style>
  <?php
  }
}

public function showeditmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selecteditmateri();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT MATERI</h4>
  </div>

  <div class="modal-body">
    <div class="box-body">
       <div class="form-group">
         <label for="id">ID List</label>
         <input type="text" class="form-control" id="id_materi" placeholder="Ketik Id" value="<?=$row->materi_id?>" readonly>
        </div>

        <div class="modal-body" id="modal_body">
          <div class="form-group">
            <label for="nama">Judul</label>
            <input type="text" class="form-control" id="id_judul" placeholder="Ketik Judul Materi" value="<?=$row->judul?>" required>
            <label for="id_nama" class="error"></label>
          </div>


        <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="form-control" rows="3" id="id_konten" name="id_konten" placeholder="Ketik Konten" value="" required><?=strip_tags($row->konten);?></textarea>
          <label for="id_alamat" class="error"></label>
          <a href='<?php echo $path; ?>'>
            <button id='btnDownload' class='submit'>Download</button>
          </a>
        </div>

        <div class="form-group">
          <label for="nik">Tanggal Posting</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            <input type="text" class="form-control pull-right" id="id_tposting" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tposting" value="<?=$row->tgl_posting?>"required>
          <label for="id_ttampil" class="error"></label>
            </div>
        </div>

        <div class="form-group">
                  <label for="mapel">Matapelajaran</label>
                  <select id="id_mapel" class="form-control" name="id_mapel" required>
                  <label for="id_mapel" class="error"></label>
                  <?php
                  $this->load->model('mcrudmateri');
                  $query = $this->mcrudmateri->selectmapel();
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
                  <label for="pengajar">Pengajar</label>
                  <select id="id_pengajar" class="form-control" name="id_pengajar" required>
                  <label for="id_pengajar" class="error"></label>
                  <?php
                  $this->load->model('mcrudmateri');
                  $query = $this->mcrudmateri->selectpengajar();
                  foreach($query->result() as $row){
                    $select = '';
                    if($row->pengajar_id == $pengajar->pengajar_id){
                      $select = 'selected';
                    }
                  ?>
                  <option value="<?=$row->pengajar_id?>" <?= $select ?>><?=$row->nama?></option>
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
                  $this->load->model('mcrudmateri');
                  $query = $this->mcrudmateri->selectkelasedit();
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
</div>

  <div class="modal-footer">
     <button id="id_materi1" type="button" class="btn btn-primary" onclick="Updmateri()">Save changes</button>
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

  public function Savemateri(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->insertmateri();
}

public function Detailmateri(){
 $this->load->model('mcrudmateri');
 $query = $this->mcrudmateri->detailmateri();
}

 public function EditMateri(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->editmateri();
}

  public function DelMateri(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->deletemateri();


}
}
?>

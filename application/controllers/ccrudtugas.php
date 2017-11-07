<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudtugas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showtugas(){
  ?>
  <div class="col-lg">
    <?php
    $this->load->model('mcrudtugas');
    $query = $this->mcrudtugas->selectParent();

    $i = 1;
    foreach($query->result() as $row){

      ?>
    <div class="panel panel-default">

      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div> <!-- KELAS X -->
      <div class="panel-body">

        <div class="col-lg">
          <?php
          $query = $this->mcrudtugas->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){

            ?>

          <div class="panel panel-default">
            <div class="panel-heading"> <h4> <?php echo $kelas->nama_kelas;?> </div> <!-- KELAS X TKJ-->
            <div class="panel-body">

              <?php
              $this->load->model('mcrudtugas');
                $query = $this->mcrudtugas->showmapel($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $kelas){
                ?>

              <div class="panel panel-default"> <!-- MAPEL -->
                <div class="panel-heading"> <h4> <?php echo $kelas->nama_mapel;?> </div> <!-- MAPEL -->
                <div class="panel-body">

              <div class="panel-body"> <!-- tugas-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Tugas</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudtugas');
                      $query = $this->mcrudtugas->showtugas($kelas->kelas_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->judul?></td>
                        <td>
                          <button onclick="DetailTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="EditTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="DelTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function addtugas(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH tugas</h4>
  </div>

  <div class="modal-body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddTugas",
         "name" => "FrmAddTugas"
     );
     echo form_open('ctrlpage/tugas',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" placeholder="Ketik Judul tugas" required>
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
                    $this->load->model('mcrudtugas');
       		  		$query = $this->mcrudtugas->selectmapel();
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
          $this->load->model('mcrudtugas');
    		  $query = $this->mcrudtugas->selectpengajar();
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
          $this->load->model('mcrudtugas');
    		  $query = $this->mcrudtugas->selectkelasadd();
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
         <button id="id_tugasbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showdetailtugas(){
  $this->load->model('mcrudtugas');
  $query=$this->mcrudtugas->selectdetailtugas();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail tugas</h4>
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
        <input type="text" class="form-control pull-right" id="id_tpost" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tpost" value="<?=$row->tgl_posting?>"required disabled>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

      <div class="form-group">
        <label for="nama">Matapelajaran</label>
        <input type="text" class="form-control" id="id_mapel" placeholder="Ketik Nama Matapelajaran" value="<?=$row->mapel_id?>" required disabled>
        <label for="id_nama" class="error"></label>
      </div>

      <div class="form-group">
        <label for="nama">Pengajar</label>
        <input type="text" class="form-control" id="id_pengajar" placeholder="Ketik Nama Matapelajaran" value="<?=$row->pengajar_id?>" required disabled>
        <label for="id_nama" class="error"></label>
      </div>

      <div class="form-group">
        <label for="nama">Kelas</label>
        <input type="text" class="form-control" id="id_kelas" placeholder="Ketik Nama Kelas" value="<?=$row->kelas_id?>" required disabled>
        <label for="id_nama" class="error"></label>
      </div>

  <div class="modal-footer">
  <!--   <button id="id_BtnEdittugas" type="button" class="btn btn-primary" onclick="Updtugas(<?=$row->id?>)">Save changes</button>
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

public function showedittugas(){
  $this->load->model('mcrudtugas');
  $query=$this->mcrudtugas->selectedittugas();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT tugas</h4>
  </div>
  <div class="modal-body">

    <div class="box-body">
       <div class="form-group">
         <label for="id">ID List</label>
         <input type="text" class="form-control" id="id_tugas" placeholder="Ketik Id" value="<?=$row->id?>" readonly="readonly">
        </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_namatugas" placeholder="Ketik Nama" value="<?=$row->nama_tugas?>" required>
      <label for="id_namatugas" class="error"></label>
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
     <button id="id_tugas1" type="button" class="btn btn-primary" onclick="Updtugas()">Save changes</button>
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

  public function Savetugas(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->inserttugas();
}

public function Detailtugas(){
 $this->load->model('mcrudtugas');
 $query = $this->mcrudtugas->detailtugas();
}

 public function Edittugas(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->edittugas();
}

  public function Deltugas(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->deletetugas();


}
}
?>

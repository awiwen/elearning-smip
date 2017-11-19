<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudtugas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
  $this->load->helper('download');
  $this->load->helper('url');
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
              foreach($query->result() as $mapel){
                ?>

              <div class="panel panel-default"> <!-- MAPEL -->
                <div class="panel-heading"> <h4> <?php echo $mapel->nama_mapel;?> </div> <!-- MAPEL -->
                <div class="panel-body">

              <div class="panel-body"> <!-- tugas-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Tugas</th>
                      <th width="30%">Tanggal Buat</th>
                      <th width="10%">File</th>
                      <th width="10%">Durasi</th>
                      <th width="30%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudtugas');
                      $query = $this->mcrudtugas->showtugas($mapel->mapel_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->judul?></td>
                        <td><?php echo $row->tgl_buat?></td>
                        <td>
                          <a href="<?php echo site_url(); ?>index.php/application/filetugas/<?=$row->file.'.jpg'?>" download="<?=$row->file.'.jpg'?>"><?=$row->file?></a>
                        </td>
                        <td><?php echo $row->durasi?></td>
                        <td>
                          <button onclick="UploadTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Upload</button>
                          <button onclick="DetailTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="JawabTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Jawab</button>
                          <button onclick="EditTugas(<?=$row->tugas_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
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
          <h4 class="modal-title">TAMBAH TUGAS</h4>
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

    <div class="form-group">
      <label for="nik">Tanggal Buat</label>
        <input type="text" class="form-control pull-right" id="id_tbuat" value="<?php echo gmdate("Y-m-d H:i:s", time()+60*60*7) ?>" required disabled>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Durasi /Menit</label>
        <input type="number" class="form-control" id="id_durasi" name="id_durasi" placeholder="Ketik Duradi / Menit" required>
        <label for="id_is" class="error"></label>
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

    <div class="col-sm-5">
      <label for="status">Status</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="2">
                          <label for="id_status2">
                            Block
                          </label>
                        </div>
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

public function showupload(){
    $this->load->model('mcrudtugas');
    $query=$this->mcrudtugas->selecttugasup();
    foreach($query->result() as $row){
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Upload Tugas</h4>
        </div>
        <div class="modal-body" style="display: inline-flex">
            <input type="file" id="file" name="file" accept="application/filetugas"/> <button id="upload">Upload</button>
            <span id="msg"></span>
        </div>
        <?php
    }
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
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Buat</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tbuat" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tbuat" value="<?=$row->tgl_buat?>"required readonly>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Durasi /Menit</label>
        <input type="text" class="form-control" id="id_durasi" name="id_durasi" placeholder="Ketik Duradi / Menit" value="<?=$row->durasi?>"required readonly>
        <label for="id_is" class="error"></label>
      </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required disabled>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectmapel();
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
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectpengajar();
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
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectkelasedit();
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

    <div class="col-sm-5">
      <label for="status">Status</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="2">
                          <label for="id_status2">
                            Block
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="3">
                          <label for="id_status3">
                            Alumni
                          </label>
                        </div>

    </div>

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
         <input type="text" class="form-control" id="id_tugas" placeholder="Ketik Id" value="<?=$row->tugas_id?>" readonly>
        </div>

          <div class="form-group">
            <label for="nama">Judul</label>
            <input type="text" class="form-control" id="id_judul" placeholder="Ketik Judul tugas" value="<?=$row->judul?>" required>
            <label for="id_nama" class="error"></label>
          </div>


        <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="form-control" rows="3" id="id_konten" name="id_konten" placeholder="Ketik Konten" value="" required><?=strip_tags($row->konten);?></textarea>
          <label for="id_alamat" class="error"></label>
        </div>

        <div class="form-group">
          <label for="nik">Tanggal Buat</label>
          <input type="text" class="form-control pull-right" id="id_tbuat" value="<?php echo gmdate("Y-m-d H:i:s", time()+60*60*7) ?>" required disabled>
            </div>
        </div>

          <div class="form-group">
            <label for="nik">Durasi /Menit</label>
            <input type="number" class="form-control" id="id_durasi" name="id_durasi" placeholder="Ketik Duradi / Menit" value="<?=$row->durasi?>"required>
            <label for="id_is" class="error"></label>
          </div>

        <div class="form-group">
                  <label for="mapel">Matapelajaran</label>
                  <select id="id_mapel" class="form-control" name="id_mapel" required>
                  <label for="id_mapel" class="error"></label>
                  <?php
                  $this->load->model('mcrudtugas');
                  $query = $this->mcrudtugas->selectmapel();
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
                  $this->load->model('mcrudtugas');
                  $query = $this->mcrudtugas->selectpengajar();
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
                  $this->load->model('mcrudtugas');
                  $query = $this->mcrudtugas->selectkelasedit();
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

    <div class="col-sm-5">
      <label for="status">Status</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="2">
                          <label for="id_status2">
                            Block
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_status" value="3">
                          <label for="id_status3">
                            Alumni
                          </label>
                        </div>

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

function upload_file($tugas_id) {
    //upload file
    $config['upload_path'] = './application/filetugas';
    $config['allowed_types'] = 'pdf|jpg|png';
    $config['max_filename'] = '255';
    $config['file_name'] = "Tugas_" . $tugas_id;
    $config['max_size'] = '10000'; //10 MB
    // jika file exists
    if (isset($_FILES['file']['name'])) {
        // jika file corupt
        if (0 < $_FILES['file']['error']) {
            echo 'Error during file upload' . $_FILES['file']['error'];
        } else {
            // jika file sudah ter-upload
            if (file_exists('uploads/' . $_FILES['file']['name'])) {
                echo 'File already exists : uploads/' . $_FILES['file']['name'];
            } else {
                $this->load->library('upload', $config);
                // jika file gagal ter-upload
                if (!$this->upload->do_upload('file')) {
                    echo $this->upload->display_errors();
                } else {
                    echo 'File successfully uploaded ' . $_FILES['file']['name'];
                    // update table tb_pks
                    $datapdf = array("file" => $config['file_name']);
                    $this->db->where("tugas_id", $tugas_id);
                    $this->db->update("tugas", $datapdf);
                }
            }
        }
    } else {
        echo 'Mohon Masukan File yang akan diupload';
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

 public function EditTugas(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->edittugas();
}

  public function DelTugas(){
  $this->load->model('mcrudtugas');
  $query = $this->mcrudtugas->deletetugas();


}

public function download()
    {
      $this->load->helper('download'); //jika sudah diaktifkan di autoload, maka tidak perlu di tulis kembali

      $name = 'default.png';
      $data = file_get_contents("index.php/application/filetugas/<?=$row->file.'.jpg'?>"); // letak file pada aplikasi kita

      force_download($name,$data);

    }
}





?>

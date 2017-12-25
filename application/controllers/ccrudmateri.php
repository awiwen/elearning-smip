<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmateri extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
  $this->load->helper(array('form', 'url'));
}

function showmateri(){
  ?>
  <!-- <div class="col-lg">
    <?php
    $this->load->model('mcrudmateri');
    $query = $this->mcrudmateri->selectParent();

    $i = 1;
    foreach($query->result() as $row){

      ?>
    <div class="panel panel-default">

      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div>
      <div class="panel-body"> -->

        <div class="col-lg">
          <?php
          $query = $this->mcrudmateri->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){

            ?>

          <div class="panel panel-default">
            <div class="panel-heading"> <h4><?php echo $kelas->nama_kelas;?> </div> <!-- KELAS X TKJ-->
            <div class="panel-body">

              <?php
              $this->load->model('mcrudmateri');
                $query = $this->mcrudmateri->showmapel($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $mapel){
                ?>

              <!-- <div class="panel panel-default">  -->
                <!-- <div class="panel-heading">  </div>  MAPEL -->
                <!-- <div class="panel-body"> -->
              <h4><b> <?php echo $mapel->nama_mapel;?> </b>
              <div class="panel-body"> <!-- MATERI-->
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="30%">Materi</th>
                      <th width="20%">Tanggal Posting</th>
                      <th width="10%">File</th>
                      <th width="20%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudmateri');
                      $query = $this->mcrudmateri->showmateri($mapel->mapel_id,$kelas->kelas_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->judul?></td>
                        <td><?php echo $row->tgl_posting?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>assets/filemateri/<?=$row->file.'.pdf'?>" download="<?=$row->file.'.pdf'?>"><?=$row->file?></a>
                        </td>
                        <td>
                          <button onclick="UploadMateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Upload</button>
                          <button onclick="DetailMateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                          <button onclick="MateriKomentar(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Komentar</button>
                          <button onclick="EditMateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                          <button onclick="Delmateri(<?=$row->materi_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                        </td>
                      </tr>
              <?php
              $i++;
              }
              ?>
                </table>
              <!-- </div>

            </div> -->
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
      <!--   </div>


      </div>
    </div>

    <?php
    }
    ?>
  </div> -->

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

    <div class="form-group">
      <label for="nik">Tanggal Posting</label>
      <input type="text" class="form-control pull-right" id="id_tposting" value="<?php echo date("Y-m-d H:i:s") ?>" required disabled>
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
       <?php
          $this->load->model('mcrudmateri');
    		  $query = $this->mcrudmateri->selectpengajar();
    		foreach($query->result() as $row){
          if($row->pengajar_id== $this->session->userdata('pengajar_id')){
    		?>
        <option value="<?=$row->pengajar_id?>"><?=$row->nama?></option>
        <?php
        }
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

public function showupload(){
    $this->load->model('mcrudmateri');
    $query=$this->mcrudmateri->selectmateriup();
    foreach($query->result() as $row){
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Upload Materi</h4>
        </div>
        <div class="modal-body" style="display: inline-flex">
            <input type="file" id="file" name="file" accept="assets/filemateri"/> <button id="upload">Upload</button>
            <span id="msg"></span>
        </div>
        <?php
    }
}

public function showdetailmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selectdetailmateri();
  foreach($query->result() as $materi){
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
      <label for="nama">Judul:</label></br>
      <text for="judul" ><?=$materi->judul?></text>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="form-control" rows="3" id="id_konten2" name="id_konten2" placeholder="Ketik Konten" value="" required readonly><?=$materi->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Posting:</label>
        <text for="judul" ><?=$materi->tgl_posting?></text>
        <label for="id_ttampil" class="error"></label>
    </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label>
              <select id="id_mapel" class="form-control" name="id_mapel" required disabled>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudmateri');
              $query = $this->mcrudmateri->selectmapeledit();
              foreach($query->result() as $row){
                $select = '';
                if($row->mapel_id == $materi->mapel_id){
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
              $query = $this->mcrudmateri->selectpengajaredit();
              foreach($query->result() as $row){
                $select = '';
                if($row->pengajar_id == $materi->pengajar_id){
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
                if($row->kelas_id == $materi->kelas_id){
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

public function showmaterikomentar(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selectdetailmateri();
  foreach($query->result() as $materi){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail Komentar</h4>
  </div>

  <div class="modal-body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddJawaban",
         "name" => "FrmAddJawaban"
     );
     echo form_open('ctrlpage/tugas',$frmattributes);
    ?>

  <div class="panel-body"> <!-- tugas-->
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="80%">Komentar</th>
          <th width="15%">Opsi</th>
        </tr>
      </thead>
      <?php
      $this->load->model('mcrudmateri');
          $query = $this->mcrudmateri->showkomentar($materi->materi_id);
      $i = 1;
      foreach($query->result() as $komentar){
        ?>
          <tr>
            <td><?php echo $i?></td>
            <td>
              <h4><b><?php echo $komentar->username?></b>:</h4>
              <?php echo $komentar->konten?>
              <br style="font-size:9px">
            <?php echo $komentar->tgl_posting?></br>
          </td>
            <td>
            <button onclick="DelKomentar(<?=$komentar->komentar_id?>)" type="button" class="fa fa-times"></button>
            </td>
          </tr>
  <?php
  $i++;
  }
  ?>
    </table>
  </div>
 </div>

 <div class="modal-header">
       <h4 class="modal-title">Tambah Komentar</h4>
   </div>

     <div class="panel-body">
        <div class="form-group">
          <label for="id">Materi</label>
          <input type="text" class="form-control" id="id_materi_id" name="id_materi_id" value="<?=$materi->materi_id?>" required readonly>
         </div>

     <div class="form-group">
       <label for="nik">Tanggal Posting</label>
         <div class="input-group date">
           <div class="input-group-addon">
             <i class="fa fa-calendar"></i>
           </div>
         <input type="text" class="form-control pull-right" id="id_tposting" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tposting" value="<?php echo date("Y-m-d H:i:s") ?>" required readonly>
       <label for="id_tposting" class="error"></label>
         </div>
     </div>

     <div class="form-group">
         <label for="siswa">User</label><br>
           <select id="id_login" style="font-size:20px" class="btn dropdown-toggle btn-default" name="id_login" required>
             <label for="id_login" class="error"></label>
         <option value=''>---- PILIH LOGIN ----</option>
        <?php
           $this->load->model('mcrudmateri');
          $query = $this->mcrudmateri->selectloginkomentar_p();
        foreach($query->result() as $row){
          if($row->username == $this->session->userdata('username')){
        ?>
         <option value="<?=$row->login_id?>"> user name: <?=$row->username?></option>
         <?php
         }
       }
         ?>
         </select>
     </div>

     <div class="form-group">
       <label for="info">Komentar</label>
         <textarea class="ckeditor" rows="3" id="id_konten" name="id_konten" placeholder="Ketik konten" required></textarea>
       <label for="id_konten" class="error"></label>
     </div>

    <div class="modal-footer">
       <button id="id_Btnkomentar" type="button" class="btn btn-primary" onclick="Savekomentar()">Simpan</button>
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

public function showeditmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selecteditmateri();
  foreach($query->result() as $materi){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT MATERI</h4>
  </div>

       <div class="form-group">
         <label for="id">ID List</label>
         <input type="text" class="form-control" id="id_materi_id" placeholder="Ketik Id" value="<?=$materi->materi_id?>" readonly>
        </div>

        <div class="modal-body" id="modal_body">
          <div class="form-group">
            <label for="nama">Judul</label>
            <input type="text" class="form-control" id="id_judul" placeholder="Ketik Judul Materi" value="<?=$materi->judul?>" required>
            <label for="id_nama" class="error"></label>
          </div>

        <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="form-control" rows="3" id="id_konten2" name="id_konten2" placeholder="Ketik Konten" value="" required><?=$materi->konten?></textarea>
          <label for="id_alamat" class="error"></label>
        </div>
        <script>
        // rubah editor
        CKEDITOR.replace('id_konten2');
        </script>

        <div class="form-group">
          <label for="nik">Tanggal Posting</label>
          <input type="text" class="form-control pull-right" id="id_tposting" value="<?php echo date("Y-m-d H:i:s") ?>" required disabled>
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
                    if($row->mapel_id == $materi->mapel_id){
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
            if($row->pengajar_id == $materi->pengajar_id){
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
                    if($row->kelas_id == $materi->kelas_id){
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
//  $query = $this->mcrudmateri->do_upload();
  //$query = $this->mcrudmateri->insertkelas();
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

  public function DelKomentar(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->deletekomentar();
  }

  public function Savekomentar(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->insertkomentar();
  }

function upload_file($materi_id) {
    //upload file
    $config['upload_path'] = './assets/filemateri';
    $config['allowed_types'] = 'pdf|jpg|png';
    $config['max_filename'] = '255';
    $config['file_name'] = "Materi_" . $materi_id;
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
                    $this->db->where("materi_id", $materi_id);
                    $this->db->update("materi", $datapdf);
                }
            }
        }
    } else {
        echo 'Mohon Masukan File yang akan diupload';
    }
  }
}
?>

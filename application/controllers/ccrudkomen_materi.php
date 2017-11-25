<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudkomen_materi extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
  $this->load->helper(array('form', 'url'));
}

function showkomen_materi(){
  ?>
  <div class="col-lg">
    <?php
    $this->load->model('mcrudkomen_materi');
    $query = $this->mcrudkomen_materi->selectParent();

    $i = 1;
    foreach($query->result() as $row){

      ?>
    <div class="panel panel-default">

      <div class="panel-heading"> <h4> <?php echo $row->nama_kelas;?> </div> <!-- KELAS X -->
      <div class="panel-body">

        <div class="col-lg">
          <?php
          $query = $this->mcrudkomen_materi->selectkelas($row->kelas_id);

          $i = 1;
          foreach($query->result() as $kelas){

            ?>

          <div class="panel panel-default">
            <div class="panel-heading"> <h4> <?php echo $kelas->nama_kelas;?> </div> <!-- KELAS X TKJ-->
            <div class="panel-body">

              <?php
              $this->load->model('mcrudkomen_materi');
                $query = $this->mcrudkomen_materi->showmapel($kelas->kelas_id);
              $i = 1;
              foreach($query->result() as $mapel){
                ?>

              <div class="panel panel-default"> <!-- MAPEL -->
                <div class="panel-heading"> <h4> Matapelajaran -  <?php echo $mapel->nama_mapel;?> </div> <!-- MAPEL -->
                <div class="panel-body">

                  <?php
                  $this->load->model('mcrudkomen_materi');
                      $query = $this->mcrudkomen_materi->showmateri($mapel->mapel_id);
                  $i = 1;
                  foreach($query->result() as $materi){
                    ?>

                  <div class="panel panel-default"> <!-- materi -->
                    <div class="panel-heading"> <h4> Materi - <?php echo $materi->judul;?> </div> <!-- MATERI -->
                    <div class="panel-body">

              <div class="panel-body"> <!-- MATERI-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Komentar</th>
                      <th width="10%">Opsi</th>
                    </tr>
                  </thead>
                  <?php
                  $this->load->model('mcrudkomen_materi');
                      $query = $this->mcrudkomen_materi->showkomen_materi($materi->materi_id);
                  $i = 1;
                  foreach($query->result() as $row){
                    ?>
                      <tr>
                        <td><?php echo $row->konten?></td>
                        <td>
                          <button onclick="Delkomen_materi(<?=$row->komentar_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function addkomen_materi(){
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
        <label for="pengajar">login id</label>
          <select id="id_login" class="form-control" name="id_login" required>
            <label for="id_login" class="error"></label>
        <option>---- PILIH LOGIN ID ----</option>
       <?php
          $this->load->model('mcrudkomen_materi');
          $query = $this->mcrudkomen_materi->selectloginadd();
        foreach($query->result() as $row){
        ?>
        <option value="<?=$row->login_id?>"><?=$row->username?></option>
        <?php
        }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pengajar">Materi</label>
          <select id="id_materi" class="form-control" name="id_materi" required>
            <label for="id_materi" class="error"></label>
        <option>---- PILIH MATERI ----</option>
       <?php
          $this->load->model('mcrudkomen_materi');
          $query = $this->mcrudkomen_materi->selectmateriadd();
        foreach($query->result() as $row){
        ?>
        <option value="<?=$row->materi_id?>"><?=$row->judul?></option>
        <?php
        }
        ?>
        </select>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Posting</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tposting" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tposting" value="<?php echo gmdate("Y-m-d H:i:s", time()+60*60*7) ?>"required readonly>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="info">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten" name="id_konten" placeholder="Ketik konten" required></textarea>
      <label for="id_konten" class="error"></label>
    </div>

  </div>
        <div class="modal-footer">
         <button id="id_komen_materibtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

  public function Savekomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query = $this->mcrudkomen_materi->insertkomen_materi();
}

  public function DelKomen_materi(){
  $this->load->model('mcrudkomen_materi');
  $query = $this->mcrudkomen_materi->deletekomen_materi();
}

}
?>

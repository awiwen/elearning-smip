<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudmateri extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showmateri(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Judul Materi</th>
                <th width="15%">Matapelajaran</th>
                <th width="10%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudmateri');
      $query = $this->mcrudmateri->selectmateri();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row->judul?></td>
                <td><?php echo $row->mapel_id?></td>
                <td>
                  <button onclick="DetailMateri(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                  <button onclick="EditMateri(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelMateri(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addmateri(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH materi</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddMateri",
       "name" => "FrmAddMateri"
   );
   echo form_open('cpage/manamateri',$frmattributes);
  ?>

  <style>
    #modal_body{
      font-size: 16px;
      font-weight: normal;
    }
  </style>
  <div class="modal-body" id="modal_body">
    <?php
     $frmattributes = array(
         "id" => "id_FrmAddMateri",
         "name" => "FrmAddMateri"
     );
     echo form_open('ctrlpage/materi',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">Judul</label>
      <input type="text" class="form-control" id="id_judul" name="id_judul" placeholder="Ketik Nama Matapelajaran" required>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="info">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten" name="id_konten" placeholder="Ketik konten" required></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tampil</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="id_ttampil" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttampil" required>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tutup</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttutup" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttutup" required>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

    <div class="col-sm-5">
      <label for="status">Akses Siswa</label>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_asiswa" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio1" id="id_asiswa" value="2">
                          <label for="id_status2">
                            Block
                          </label>
                        </div>
                      </div>

    <div class="col-sm-5">
      <label for="status">Akses Pengajar</label>
                        <div class="radio">
                          <input type="radio" name="radio2" id="id_apengajar" value="1" checked="">
                          <label for="id_status">
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <input type="radio" name="radio2" id="id_apengajar" value="2">
                          <label for="id_status2">
                            Block
                          </label>
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

public function showeditmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selecteditmateri();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT materi</h4>
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
        <textarea class="form-control" rows="3" id="id_konten2" name="id_konten" placeholder="Ketik Konten" value="" required><?=$row->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Tampil</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttampil" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttampil" value="<?=$row->tgl_tampil?>"required>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tutup</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttutup" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttutup" value="<?=$row->tgl_tutup?>"required>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

    <div class="col-sm-5">
      <label for="status">Akses Siswa</label>
      <div class="radio">
        <input type="radio" name="radio1" id="id_asiswa" value="1" checked="">
        <label for="id_status">
        Aktif
        </label>
      </div>
      <div class="radio">
        <input type="radio" name="radio1" id="id_asiswa" value="2">
        <label for="id_status2">
        Block
        </label>
      </div>
    </div>

    <div class="col-sm-5">
      <label for="status">Akses Pengajar</label>
      <div class="radio">
        <input type="radio" name="radio2" id="id_apengajar" value="1" checked="">
        <label for="id_status">
        Aktif
        </label>
      </div>
      <div class="radio">
        <input type="radio" name="radio2" id="id_apengajar" value="2">
        <label for="id_status2">
        Block
        </label>
      </div>
    </div>
 </div>

  <div class="modal-footer">
     <button id="id_BtnEditMateri" type="button" class="btn btn-primary" onclick="Updmateri(<?=$row->id?>)">Save changes</button>
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


public function showdetailmateri(){
  $this->load->model('mcrudmateri');
  $query=$this->mcrudmateri->selectdetailmateri();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail materi</h4>
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
      <label for="nik">Tanggal Tampil</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttampil" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttampil" value="<?=$row->tgl_tampil?>"required>
      <label for="id_ttampil" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Tutup</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_ttutup" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_ttutup" value="<?=$row->tgl_tutup?>"required>
      <label for="id_ttutup" class="error"></label>
        </div>
    </div>

    <div class="col-sm-5">
      <label for="status">Akses Siswa</label>
      <div class="radio">
        <input type="radio" name="radio1" id="id_asiswa" value="1" checked="">
        <label for="id_status">
        Aktif
        </label>
      </div>
      <div class="radio">
        <input type="radio" name="radio1" id="id_asiswa" value="2">
        <label for="id_status2">
        Block
        </label>
      </div>
    </div>

    <div class="col-sm-5">
      <label for="status">Akses Pengajar</label>
      <div class="radio">
        <input type="radio" name="radio2" id="id_apengajar" value="1" checked="">
        <label for="id_status">
        Aktif
        </label>
      </div>
      <div class="radio">
        <input type="radio" name="radio2" id="id_apengajar" value="2">
        <label for="id_status2">
        Block
        </label>
      </div>
    </div>
 </div>

  <div class="modal-footer">
  <!--   <button id="id_BtnEditmateri" type="button" class="btn btn-primary" onclick="Updmateri(<?=$row->id?>)">Save changes</button>
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


  public function savemateri(){

  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->insertmateri();
}

 public function Editmateri(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->editmateri();
}

public function Detailmateri(){
 $this->load->model('mcrudmateri');
 $query = $this->mcrudmateri->detailmateri();
}

  public function Delmateri(){
  $this->load->model('mcrudmateri');
  $query = $this->mcrudmateri->deletemateri();


}
}
?>

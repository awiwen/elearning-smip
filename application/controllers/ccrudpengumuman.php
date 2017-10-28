<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudpengumuman extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showpengumuman(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Judul Pengumuman</th>
                <th width="15%">Tanggal Tampil</th>
                <th width="15%">Tanggal Tutup</th>
                <th width="10%">Akses Siswa</th>
                <th width="10%">Akses Pengajar</th>
                <th width="10%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudpengumuman');
      $query = $this->mcrudpengumuman->selectpengumuman();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row->judul?></td>
                <td><?php echo $row->tgl_tampil?></td>
                <td><?php echo $row->tgl_tutup?></td>
                <td><?php echo $row->status_nama?></td>
                <td><?php echo $row->status_nama?></td>
                <td>
                  <button onclick="DetailPengumuman(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Detail</button>
                  <button onclick="EditPengumuman(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelPengumuman(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addpengumuman(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH PENGUMUMAN</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddPengumuman",
       "name" => "FrmAddPengumuman"
   );
   echo form_open('cpage/manapengumuman',$frmattributes);
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
         "id" => "id_FrmAddPengumuman",
         "name" => "FrmAddPengumuman"
     );
     echo form_open('ctrlpage/pengumuman',$frmattributes);
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
         <button id="id_pengumumanbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query=$this->mcrudpengumuman->selecteditpengumuman();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT PENGUMUMAN</h4>
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
     <button id="id_BtnEditPengumuman" type="button" class="btn btn-primary" onclick="Updpengumuman(<?=$row->id?>)">Save changes</button>
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


public function showdetailpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query=$this->mcrudpengumuman->selectdetailpengumuman();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail PENGUMUMAN</h4>
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
  <!--   <button id="id_BtnEditPengumuman" type="button" class="btn btn-primary" onclick="Updpengumuman(<?=$row->id?>)">Save changes</button>
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


  public function savepengumuman(){

  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->insertpengumuman();
}

 public function Editpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->editpengumuman();
}

public function Detailpengumuman(){
 $this->load->model('mcrudpengumuman');
 $query = $this->mcrudpengumuman->detailpengumuman();
}

  public function Delpengumuman(){
  $this->load->model('mcrudpengumuman');
  $query = $this->mcrudpengumuman->deletepengumuman();


}
}
?>

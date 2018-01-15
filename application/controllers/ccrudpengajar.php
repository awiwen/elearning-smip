<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudpengajar extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showpengajar(){
  ?>
   <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th width="3%">No</th>
                <!-- <th width="12%">NUPTK</th> -->
                <th width="20%">Nama</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="10%">Bidang Studi</th>
                <th width="20%">Alamat</th>
                <th width="3%">Status</th>
                <th width="5%">Opsi</th>
            </tr>
          </thead>
        <tbody>
          <?php
      $this->load->model('mcrudpengajar');
          $query = $this->mcrudpengajar->selectpengajar();
      $i = 1;
      foreach($query->result() as $row){
        ?>
      <tr>
                <td><?php echo $i ?></td>
                <!-- <td><?php echo $row->nuptk ?></td> -->
                <td><?php echo $row->nama ?></td>
                <td><?php echo $row->jenis_kelamin?></td>
                <td><?php echo $row->b_studi ?></td>
                <td><?php echo $row->alamat ?></td>
                <td><?php echo $row->status_nama?></td>
                <td>
                  <script>
                  function redirect(url){
                    location.href = url;
                  }
                  </script>
                  <button onclick="redirect('http://localhost/elearning-smip/index.php/cdetailpengajar/showdetailpengajar/<?= $row->pengajar_id?>')"
                    type="button" class="btn btn-primary btn-xs">Detail</button>

                  <button onclick="EditPengajar(<?=$row->pengajar_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelPengajar(<?=$row->pengajar_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                </td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}

public function addpengajar(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH PENGAJAR</h4>
  </div>

  <?php
   $frmattributes = array(
       "id" => "id_FrmAddPengajar",
       "name" => "FrmAddPengajar"
   );
   echo form_open('cpage/pengajar',$frmattributes);
  ?>

  <div class="modal-body">

    <div class="box-body">
      <div class="form-group">
        <label for="nuptk">NUPTK</label>
        <input type="number" class="form-control" id="id_nuptk" name="id_nuptk" placeholder="Ketik NUPTK" required>
        <label for="id_nuptk" class="error"></label>
      </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_nama" name="id_nama" placeholder="Ketik Nama" required>
      <label for="id_nama" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">jenis Kelamin</label>
          <select id="id_jk" name="id_jk" class="form-control" data-toggle="dropdown" title="Nothing selected" required>
            <option value="" >--Pilih Jenis Kelamin-- </option>
            <option value="Laki-laki" >Laki-laki </option>
            <option value="Perempuan" >Perempuan</option>
          </select>
        <label for="id_jk" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tempat Lahir</label>
          <input type="text" class="form-control" id="id_tel" name="id_tel" placeholder="Tempat Lahir" required>
        <label for="id_tel" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Lahir</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tam" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tam" required>
      <label for="id_tam" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Alamat</label>
        <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" required></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Pendidikan Terakhir</label>
          <input type="text" class="form-control" id="id_pend_terakhir" name="id_pend_terakhir" placeholder="Pendidikan Terakhir" required>
        <label for="id_pend_terakhir" class="error"></label>
      </div>


      <div class="form-group">
        <label for="nik">Bidang Studi</label>
          <input type="text" class="form-control" id="id_b_studi" name="id_b_studi" placeholder="Bidang Studi" required>
        <label for="id_b_studi" class="error"></label>
    </div>

    <!-- <div class="box-body"> -->
      <div class="form-group">
        <label for="nik">Tahun Masuk</label>
          <input type="year" class="form-control" id="id_th_masuk" name="id_th_masuk" placeholder="Tahun Masuk" required>
        <label for="id_th_masuk" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Status Pengajar</label>
        <input type="text" class="form-control" id="id_status_kg" name="id_status_kg" placeholder="Status Pengajar" required>
      <label for="id_status_kg" class="error"></label>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
        <select id="id_status" name="id_status" class="form-control" required>
          <option value=""> ---PILIH STATUS--- </option>
          <option value="1" >Aktif </option>
          <option value="2" >Block</option>
        </select>
      <label for="id_status" class="error"></label>
    </div>

        <div class="modal-footer">
         <button id="id_pengajarbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showeditpengajar(){
  $this->load->model('mcrudpengajar');
  $query=$this->mcrudpengajar->selecteditpengajar();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT PENGAJAR</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID List</label>
      <input type="text" class="form-control" id="id_pengajar" placeholder="Ketik Id" value="<?=$row->pengajar_id?>" readonly="readonly">
     </div>

      <div class="form-group">
        <label for="nik">NUPTK</label>
        <input type="number" class="form-control" id="id_nuptk" name="id_nuptk" placeholder="Ketik NUPTK" value="<?=$row->nuptk?>" required>
        <label for="id_nip" class="error"></label>
      </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="id_nama" placeholder="Ketik Nama" value="<?=$row->nama?>" required>
      <label for="id_nama" class="error"></label>
    </div>

     <div class="form-group">
        <label for="jkel">jenis Kelamin</label>
          <select id="id_jk" name="id_jk" class="form-control" >
            <option selected="selected"><?=$row->jenis_kelamin?></option>
            <option value="laki-laki" >laki-laki </option>
            <option value="perempuan" >Perempuan</option>
          </select>
        <label for="id_jk" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tempat Lahir</label>
          <input type="text" class="form-control" id="id_tel" name="id_tel" placeholder="Tempat Lahir" value="<?=$row->tempat_lahir?>" required>
        <label for="id_tel" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Tanggal Lahir</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        <input type="text" class="form-control pull-right" id="id_tam" placeholder="YYYY/MM/DD" data-date-format="yyyy/mm/dd" name="id_tam" value="<?=$row->tgl_lahir?>" required>
      <label for="id_tam" class="error"></label>
        </div>
    </div>

    <div class="form-group">
      <label for="nik">Alamat</label>
        <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" value="" required><?=$row->alamat?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Pendidikan Terakhir</label>
          <input type="text" class="form-control" id="id_pend_terakhir" name="id_pend_terakhir" placeholder="Pendidikan Terakhir" value="<?=$row->pend_terakhir?>" required></input>
        <label for="id_pend_terakhir" class="error"></label>
      </div>


      <div class="form-group">
        <label for="nik">Bidang Studi</label>
          <input type="text" class="form-control" id="id_b_studi" name="id_b_studi" placeholder="Bidang Studi" value="<?=$row->b_studi?>" required></input>
        <label for="id_b_studi" class="error"></label>
    </div>

    <!-- <div class="box-body"> -->
      <div class="form-group">
        <label for="nik">Tahun Masuk</label>
          <input type="year" class="form-control" id="id_th_masuk" name="id_th_masuk" placeholder="Tahun Masuk" value="<?=$row->tahun_masuk?>" required></input>
        <label for="id_th_masuk" class="error"></label>
    </div>

    <div class="form-group">
      <label for="nik">Status Pengajar</label>
        <input type="text" class="form-control" id="id_status_kg" name="id_status_kg" placeholder="Status Pengajar" value="<?=$row->status_kg?>" required></input>
      <label for="id_status_kg" class="error"></label>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
        <select id="id_status" name="id_status" class="form-control">

          <option value="<?=$row->status_id?>"><?=$row->status_nama?> </option>
          <option value="1" >Aktif </option>
          <option value="2" >Block</option>
        </select>
      <label for="id_status" class="error"></label>
    </div>

 </div>
</div>
</div>

  <div class="modal-footer">
     <button id="id_pengajar1" type="button" class="btn btn-primary" onclick="Updpengajar()">Save changes</button>
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

  public function savepengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->insertpengajar();
}

 public function Editpengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->editpengajar();
}

  public function DelPengajar(){
  $this->load->model('mcrudpengajar');
  $query = $this->mcrudpengajar->deletepengajar();


}
}
?>

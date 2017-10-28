  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudsiswa extends CI_Controller {

  /* i. function construct */
  function __construct(){
    parent::__construct();
  }

  function showsiswa(){
    ?>
     <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                  <th width="3%">No</th>
                  <th width="5%">NIS</th>
                  <th width="10%">Nama</th>
                  <th width="10%">Jenis Kelamin</th>
                  <th width="5%">Tempat Lahir</th>
                  <th width="10%">Tanggal Lahir</th>
                  <th width="17%">Agama</th>
                  <th width="20%">Alamat</th>
                  <th width="10%">Tahun Masuk</th>
                  <th width="5%">Status</th>
                  <th width="5%">Opsi</th>
              </tr>
            </thead>
          <tbody>
            <?php
        $this->load->model('mcrudsiswa');
        $query = $this->mcrudsiswa->selectsiswa();
        $i = 1;
        foreach($query->result() as $row){
          ?>
        <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->nis ?></td>
                  <td><?php echo $row->nama ?></td>
                  <td><?php echo $row->jenis_kelamin?></td>
                  <td><?php echo $row->tempat_lahir ?></td>
                  <td><?php echo $row->tgl_lahir ?></td>
                  <td><?php echo $row->agama ?></td>
                  <td><?php echo $row->alamat ?></td>
                  <td><?php echo $row->tahun_masuk ?></td>
                  <td><?php echo $row->status_nama?></td>
                  <td>
                    <button onclick="EditSiswa(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                    <button onclick="DelSiswa(<?=$row->id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
                  </td>
                </tr>
        <?php
        $i++;
        }
        ?>
        </table>
    <?php
  }

  public function addsiswa(){
    ?>
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">TAMBAH SISWA</h4>
    </div>
    <div class="modal-body">

      <?php
       $frmattributes = array(
           "id" => "id_FrmAddSiswa",
           "name" => "FrmAddSiswa"
       );
       echo form_open('ctrlpage/siswa',$frmattributes);
      ?>

      <div class="box-body">
        <div class="form-group">
          <label for="nik">NIS</label>
          <input type="text" class="form-control" id="id_is" name="id_is" placeholder="Ketik NIM" required>
          <label for="id_is" class="error"></label>
        </div>

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="id_nama" name="id_nama" placeholder="Ketik Nama" required>
        <label for="id_nama" class="error"></label>
      </div>

       <div class="form-group">
          <label for="jkel">jenis Kelamin</label>
            <select id="id_jk" name="id_jk" class="form-control">
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
          <label for="agama">Agama</label>
            <select id="id_agama" name="id_agama" class="form-control">
              <option value="Kristen Katolik" >Kristen Katolik </option>
              <option value="Kristen Protestan" >Kristen Protestan</option>
              <option value="Hindu" >Hindu</option>
              <option value="Islam" >Islam</option>
              <option value="Budha" >Budha</option>
            </select>
      </div>

      <div class="form-group">
        <label for="nik">Alamat</label>
          <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" required></textarea>
        <label for="id_alamat" class="error"></label>
      </div>

      <div class="form-group">
        <label for="nama">Tahun Masuk</label>
          <input type="text" class="form-control" id="id_tm" name="id_tm" placeholder="Ketik Tahun Masuk" required>
        <label for="id_tm" class="error"></label>
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
          <div class="modal-footer">
           <button id="id_siswabtn" type="button" class="btn btn-primary">Simpan</button>
          </div>
    <style>
      .error{
      color: red;
      font-style: italic;
             }
    </style>
      <?php
  }

  public function showeditsiswa(){
    $this->load->model('mcrudsiswa');
    $query=$this->mcrudsiswa->selecteditsiswa();
    foreach($query->result() as $row){
      ?>
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">EDIT SISWA</h4>
    </div>
    <div class="modal-body">

      <div class="box-body">


        <div class="form-group">
          <label for="nik">NIS</label>
          <input type="text" class="form-control" id="id_is" name="id_is" placeholder="Ketik NIM" value="<?=$row->nis?>" required>
          <label for="id_is" class="error"></label>
        </div>

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="id_nama" placeholder="Ketik Nama" value="<?=$row->nama?>" required>
        <label for="id_nama" class="error"></label>
      </div>

       <div class="form-group">
          <label for="jkel">jenis Kelamin</label>
            <select id="id_jk" name="id_jk" class="form-control">
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
          <label for="agama">Agama</label>
            <select id="id_agama" name="id_agama" class="form-control">
              <option selected="selected"><?=$row->agama?></option>
              <option value="Kristen Katolik" >Kristen Katolik </option>
              <option value="Kristen Protestan" >Kristen Protestan</option>
              <option value="Hindu" >Hindu</option>
              <option value="Islam" >Islam</option>
              <option value="Budha" >Budha</option>
            </select>
          <label for="id_agama" class="error"></label>
      </div>

      <div class="form-group">
        <label for="nik">Alamat</label>
          <textarea class="form-control" rows="3" id="id_alamat" name="id_alamat" placeholder="Ketik Alamat" value="" required><?=$row->alamat?></textarea>
        <label for="id_alamat" class="error"></label>
      </div>

      <div class="form-group">
        <label for="nama">Tahun Masuk</label>
          <input type="text" class="form-control" id="id_tm" name="id_tm" placeholder="Ketik Tahun Masuk" value="<?=$row->tahun_masuk?>" required>
        <label for="id_tm" class="error"></label>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
          <select id="id_status" name="id_status" class="form-control">
            <option selected="selected"><?=$row->status_id?></option>
            <option value="akt" >Aktif</option>
            <option value="bl" >Blocking</option>
            <option value="al" >Alumni</option>
          </select>
        <label for="id_status" class="error"></label>
      </div>
   </div>
</div>
</div>

    <div class="modal-footer">
       <button id="id_siswa1" type="button" class="btn btn-primary" onclick="UpdSiswa()">Save changes</button>
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

    public function savesiswa(){

    $this->load->model('mcrudsiswa');
    $query = $this->mcrudsiswa->insertsiswa();
  }

   public function EditSiswa(){
    $this->load->model('mcrudsiswa');
    $query = $this->mcrudsiswa->editsiswa();
  }

    public function DelSiswa(){
    $this->load->model('mcrudsiswa');
    $query = $this->mcrudsiswa->deletesiswa();


  }
}
?>

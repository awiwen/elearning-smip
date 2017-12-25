<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdetailtugas extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
  $this->load->helper('url');
}
public function showdetailtugas(){
  $this->load->model('mcrudtugas');
  $query=$this->mcrudtugas->selectdetailtugas();
  foreach($query->result() as $tugas){
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
      <label for="nama">Judul:</label></br>
      <text for="judul" ><?=$tugas->judul?></text>
      <label for="id_nama" class="error"></label>
    </div>

    <div class="form-group">
      <label for="konten">Konten</label>
        <textarea class="ckeditor" rows="3" id="id_konten2" name="id_konten2" placeholder="Ketik Konten" value="" required><?=$tugas->konten?></textarea>
      <label for="id_alamat" class="error"></label>
    </div>
    <script>
    // rubah editor
    CKEDITOR.replace('id_konten2');
    </script>

    <div class="form-group">
      <label for="nik">Tanggal Buat:</label>
        <text for="judul" ><?=$tugas->tgl_buat?></text>
        <label for="id_ttampil" class="error"></label>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="nik">Tanggal Selesai:</label>
        <text for="judul" ><?=$tugas->tgl_selesai?></text>
        <label for="id_is" class="error"></label>
      </div>

    <div class="form-group">
              <label for="mapel">Matapelajaran</label><br>
              <select id="id_mapel" class="btn dropdown-toggle btn-default" name="id_mapel" required disabled>
              <label for="id_mapel" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectmapeledit();
              foreach($query->result() as $row){
                $select = '';
                if($row->mapel_id == $tugas->mapel_id){
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
              <label for="pengajar">Pengajar</label><br>
              <select id="id_pengajar" class="btn dropdown-toggle btn-default" name="id_pengajar" required disabled>
              <label for="id_pengajar" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectpengajar();
              foreach($query->result() as $row){
                $select = '';
                if($row->pengajar_id == $tugas->pengajar_id){
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
              <label for="mapel">Kelas</label><br>
              <select id="id_kelas" class="btn dropdown-toggle btn-default" name="id_kelas" required disabled>
              <label for="id_kelas" class="error"></label>
              <?php
              $this->load->model('mcrudtugas');
              $query = $this->mcrudtugas->selectkelasedit();
              foreach($query->result() as $row){
                $select = '';
                if($row->kelas_id == $tugas->kelas_id){
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
  <!--   <button id="id_BtnEdittugas" type="button" class="btn btn-primary" onclick="Updtugas(<?=$row->id?>)">Save changes</button>
  --></div>
  <style>
    .error{
    color: red;
    font-style: italic;
    }
  </style>

  }
}

}

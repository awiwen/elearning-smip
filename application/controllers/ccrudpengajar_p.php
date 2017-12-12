<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudpengajar_p extends CI_Controller {

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
                <th width="5%">NIP</th>
                <th width="10%">Nama</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="5%">Tempat Lahir</th>
                <th width="10%">Tanggal Lahir</th>
                <th width="20%">Alamat</th>
                <th width="5%">Status</th>
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
                <td><?php echo $row->nip ?></td>
                <td><?php echo $row->nama ?></td>
                <td><?php echo $row->jenis_kelamin?></td>
                <td><?php echo $row->tempat_lahir ?></td>
                <td><?php echo $row->tgl_lahir ?></td>
                <td><?php echo $row->alamat ?></td>
                <td><?php echo $row->status_nama?></td>
              </tr>
      <?php
      $i++;
      }
      ?>
      </table>
  <?php
}
}
?>
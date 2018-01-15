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

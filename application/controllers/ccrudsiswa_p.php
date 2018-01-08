  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccrudsiswa_p extends CI_Controller {

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
                  <th width="5%">Tempat/Tanggal Lahir</th>
                  <th width="17%">Agama</th>
                  <th width="20%">Alamat</th>
                  <th width="10%">Tahun Masuk</th>
                  <th width="10%">Kelas</th>
                  <th width="5%">Status</th>
              </tr>
            </thead>
          <tbody>
            <?php
        $this->load->model('mcrudsiswa');
        $query = $this->mcrudsiswa->selectsiswa_p();
        $i = 1;
        foreach($query->result() as $row){
          ?>
        <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->nis ?></td>
                  <td><?php echo $row->nama ?></td>
                  <td><?php echo $row->jenis_kelamin?></td>
                  <td><?php echo $row->tempat_lahir ?> / <?php echo $row->tanggal ?></td>
                  <td><?php echo $row->agama ?></td>
                  <td><?php echo $row->alamat ?></td>
                  <td><?php echo $row->tahun_masuk ?></td>
                  <td><?php echo $row->nama_kelas ?></td>
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

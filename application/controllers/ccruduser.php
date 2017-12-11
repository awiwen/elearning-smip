<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccruduser extends CI_Controller {

/* i. function construct */
function __construct(){
  parent::__construct();
}

function showuser(){
  ?>

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"> <h4> Admin </h4></div>
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">User Name</th>
              <th width="30%">ID</th>
              <th width="30%">Nama Admin</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcruduser');
          $query = $this->mcruduser->selectsebagaiadmin();
      $i = 1;
      foreach($query->result() as $row){
        ?>
              <tr>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->admin_id ?></td>
                <td><?php echo $row->admin_nama ?></td>
                <td>
                  <button onclick="EditUserAdmin(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelUser(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"> <h4> Pengajar </h4></div>
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">User Name</th>
              <th width="30%">NIP</th>
              <th width="30%">Nama</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcruduser');
          $query = $this->mcruduser->selectsebagaipengajar();
      $i = 1;
      foreach($query->result() as $row){
        ?>
              <tr>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->nip ?></td>
                <td><?php echo $row->nama ?></td>
                <td>
                  <button onclick="EditUserPengajar(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelUser(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

  <div class="col-lg">
    <div class="panel panel-default">
      <div class="panel-heading"> <h4> Siswa </h4></div>
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="30%">User Name</th>
              <th width="30%">NIS</th>
              <th width="30%">Nama</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <?php
      $this->load->model('mcruduser');
          $query = $this->mcruduser->selectsebagaisiswa();
      $i = 1;
      foreach($query->result() as $row){
        ?>
              <tr>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->nis ?></td>
                <td><?php echo $row->nama ?></td>
                <td>
                  <button onclick="EditUserSiswa(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Edit</button>
                  <button onclick="DelUser(<?=$row->login_id?>)" type="button" class="btn btn-primary btn-xs">Hapus</button>
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

public function adduser(){
  ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">TAMBAH USER</h4>
  </div>

  <div class="modal-body">

    <?php
     $frmattributes = array(
         "id" => "id_FrmAddUser",
         "name" => "FrmAddUser"
     );
     echo form_open('ctrlpage/user',$frmattributes);
    ?>

    <div class="form-group">
      <label for="nama">User Name</label>
      <input type="text" class="form-control" id="id_username" name="id_username" placeholder="ketik username" required>
      <label for="id_username" class="error"></label>
    </div>

    <div class="form-group">
      <label class="password1">Password</label>
        <input type="password" id="id_password1" class="form-control" name="id_password1" placeholder="ketik password" required>
    </div>

    <div class="form-group">
      <label class="password2">Ulangi Password</label>
        <input type="password" id="id_password2" class="form-control" name="id_password2" placeholder="Ketik ulang password" required>
    </div>

    <div class="form-group">
              <label for="admin">Admin</label>
              <select id="id_admin" class="form-control" name="id_admin" onchange="admin_change()" required>
              <label for="id_admin" class="error"></label>
                <option>---- PILIH ADMIN ----</option>
                  <?php
                    $this->load->model('mcruduser');
                    $query = $this->mcruduser->selectadmin();
                    foreach($query->result() as $row){
                  ?>
                <option value="<?=$row->admin_id?>">ID : <?=$row->admin_id?> &emsp; NAMA : <?=$row->admin_nama?></option>
                <?php
                }
                ?>
            </select>
    </div>

    <div class="form-group">
              <label for="pengajar">Pengajar</label>
              <select id="id_pengajar" class="form-control" name="id_pengajar" onchange="pengajar_change()" required>
              <label for="id_pengajar" class="error"></label>
                <option>---- PILIH PENGAJAR ----</option>
                  <?php
                    $this->load->model('mcruduser');
                    $query = $this->mcruduser->selectpengajar();
                    foreach($query->result() as $row){
                  ?>
                <option value="<?=$row->pengajar_id?>">NIP : <?=$row->nip?> &emsp; NAMA : <?=$row->nama?></option>
                <?php
                }
                ?>
            </select>
    </div>

    <div class="form-group">
              <label for="siswa">Siswa</label>
              <select id="id_siswa" class="form-control" name="id_siswa"  onchange="siswa_change()" required>
              <label for="id_siswa" class="error"></label>
                <option>---- PILIH SISWA ----</option>
                  <?php
                    $this->load->model('mcruduser');
                    $query = $this->mcruduser->selectsiswa();
                    foreach($query->result() as $row){
                  ?>
                <option value="<?=$row->siswa_id?>">NIM : <?=$row->nis?> &emsp; NAMA : <?=$row->nama?></option>
                <?php
                }
                ?>
            </select>
    </div>

    <div class="form-group">
                    <label for="level">Level</label>
                    <select id="id_usrlevel" name="id_usrlevel" class="form-control" required>
                       <option value="">---- PILIH LEVEL ----</option>
                       <option value="Admin">Admin</option>
                       <option value="Pengajar">Pengajar</option>
                       <option value="Siswa">Siswa</option>
                    </select>
                    <label for="id_usrlevel" class="error"></label>
                </div>

        <div class="modal-footer">
         <button id="id_userbtn" type="button" class="btn btn-primary">Simpan</button>
        </div>
  <style>
    .error{
    color: red;
    font-style: italic;
           }
  </style>
    <?php
}

public function showedituserAdmin(){
  $this->load->model('mcruduser');
  $query=$this->mcruduser->selectedituser();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT user</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID Login</label>
      <input type="text" class="form-control" id="id_login" placeholder="Ketik Id" value="<?=$row->login_id?>" readonly="readonly">
     </div>

    <div class="form-group">
      <label for="nama">User Name</label>
      <input type="text" class="form-control" id="id_username" placeholder="Ketik Nama user" value="<?=$row->username?>" required>
      <label for="id_namauser" class="error"></label>
    </div>

    <div class="form-group">
      <label class="password1">New Password</label>
        <input type="password" id="id_password1" class="form-control" name="id_password1" placeholder="ketik password" value="<?=$row->password?>"required>
    </div>

    <div class="form-group">
      <label class="password2">Ulangi Password</label>
        <input type="password" id="id_password2" class="form-control" name="id_password2" placeholder="Ketik ulang password" value="<?=$row->password?>" required>
    </div>

    <div class="form-group">
      <label for="mapel">Admin</label>
        <select id="id_admin" class="form-control" name="id_admin" onchange="admin_change()" required>
          <label for="id_admin" class="error"></label>
          <?php
          $this->load->model('mcruduser');
          $query = $this->mcruduser->selectadmin();
          foreach($query->result() as $row){
            $select = '';
            if($row->login_id == $admin->login_id){
              $select = 'selected';
            }
          ?>
          <option value="<?=$row->admin_id?>" <?= $select ?>> ID : <?=$row->admin_id?> NAMA : <?=$row->admin_nama?></option>
          <?php
          }
          ?>
        </select>
    </div>

    <div class="form-group">
                    <label for="level">Level</label>
                    <select id="id_usrlevel" name="id_usrlevel" class="form-control" required>
                       <option value="">---- PILIH LEVEL ----</option>
                       <option value="Admin">Admin</option>
                       <option value="Pengajar">Pengajar</option>
                       <option value="Siswa">Siswa</option>
                    </select>
                    <label for="id_usrlevel" class="error"></label>
                </div>

  <div class="modal-footer">
     <button id="id_user1" type="button" class="btn btn-primary" onclick="UpduserAdmin()">Save changes</button>
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

public function showedituserPengajar(){
  $this->load->model('mcruduser');
  $query=$this->mcruduser->selectedituser();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT user</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID Login</label>
      <input type="text" class="form-control" id="id_login" placeholder="Ketik Id" value="<?=$row->login_id?>" readonly="readonly">
     </div>

    <div class="form-group">
      <label for="nama">User Name</label>
      <input type="text" class="form-control" id="id_username" placeholder="Ketik Nama user" value="<?=$row->username?>" required>
      <label for="id_namauser" class="error"></label>
    </div>

    <div class="form-group">
      <label class="password">New Password</label>
        <input type="password" id="id_password" class="form-control" name="password" value="<?=$row->password?>" required>
    </div>

    <div class="form-group">
              <label for="mapel">Pengajar</label>
              <select id="id_pengajar" class="form-control" name="id_pengajar" onchange="pengajar_change()" required>
              <label for="id_pengajar" class="error"></label>
              <?php
              $this->load->model('mcruduser');
              $query = $this->mcruduser->selectpengajar();
              foreach($query->result() as $row){
                $select = '';
                if($row->login_id == $pengajar->login_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->pengajar_id?>" <?= $select ?>> NIP : <?=$row->nip?> NAMA : <?=$row->nama?></option>
              <?php
              }
              ?>
              </select>
    </div>

    <div class="form-group">
                    <label for="level">Level</label>
                    <select id="id_usrlevel" name="id_usrlevel" class="form-control" required>
                       <option value="">---- PILIH LEVEL ----</option>
                       <option value="Admin">Admin</option>
                       <option value="Pengajar">Pengajar</option>
                       <option value="Siswa">Siswa</option>
                    </select>
                    <label for="id_usrlevel" class="error"></label>
                </div>

  <div class="modal-footer">
     <button id="id_user1" type="button" class="btn btn-primary" onclick="UpduserPengajar()">Save changes</button>
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

public function showedituserSiswa(){
  $this->load->model('mcruduser');
  $query=$this->mcruduser->selectedituser();
  foreach($query->result() as $row){
    ?>
  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">EDIT user</h4>
  </div>
  <div class="modal-body">

    <div class="form-group">
      <label for="id">ID Login</label>
      <input type="text" class="form-control" id="id_login" placeholder="Ketik Id" value="<?=$row->login_id?>" readonly="readonly">
     </div>

    <div class="form-group">
      <label for="nama">User Name</label>
      <input type="text" class="form-control" id="id_username" placeholder="Ketik Nama user" value="<?=$row->username?>" required>
      <label for="id_namauser" class="error"></label>
    </div>

    <div class="form-group">
      <label class="password">New Password</label>
        <input type="password" id="id_password" class="form-control" name="password" value="<?=$row->password?>" required>
    </div>

    <div class="form-group">
              <label for="mapel">Siswa</label>
              <select id="id_siswa" class="form-control" name="id_siswa" onchange="siswa_change()" required>
              <label for="id_siswa" class="error"></label>
              <?php
              $this->load->model('mcruduser');
              $query = $this->mcruduser->selectsiswa();
              foreach($query->result() as $row){
                $select = '';
                if($row->kelas_id == $siswa->kelas_id){
                  $select = 'selected';
                }
              ?>
              <option value="<?=$row->siswa_id?>" <?= $select ?>> NIS : <?=$row->nis?> NAMA : <?=$row->nama?></option>
              <?php
              }
              ?>
              </select>
    </div>
 </div>
</div>

<div class="form-group">
                <label for="level">Level</label>
                <select id="id_usrlevel" name="id_usrlevel" class="form-control" required>
                   <option value="">---- PILIH LEVEL ----</option>
                   <option value="Admin">Admin</option>
                   <option value="Pengajar">Pengajar</option>
                   <option value="Siswa">Siswa</option>
                </select>
                <label for="id_usrlevel" class="error"></label>
            </div>

  <div class="modal-footer">
     <button id="id_user1" type="button" class="btn btn-primary" onclick="UpduserSiswa()">Save changes</button>
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

  public function SaveUser(){
  $this->load->model('mcruduser');
  $query = $this->mcruduser->insertuser();
}

 public function Edituseradmin(){
  $this->load->model('mcruduser');
  $query = $this->mcruduser->edituseradmin();
}

public function Edituserpengajar(){
 $this->load->model('mcruduser');
 $query = $this->mcruduser->edituserpengajar();
}

public function Editusersiswa(){
 $this->load->model('mcruduser');
 $query = $this->mcruduser->editusersiswa();
}

  public function DelUser(){
  $this->load->model('mcruduser');
  $query = $this->mcruduser->deleteuser();


}



}
?>

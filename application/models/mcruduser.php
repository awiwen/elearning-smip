<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcruduser extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectsebagaiadmin(){
		$query = $this->db->query("select login_id, username, password, admin_id FROM login WHERE admin_id is not null");
    $this->db->select('*');
		$this->db->join('admin', 'admin.admin_id = login.admin_id','on');
    $query = $this->db->get('login');
    $this->db->last_query();
		return $query;
	}

  function selectsebagaipengajar(){
		$query = $this->db->query("select login_id, username, password, pengajar_id FROM login WHERE pengajar_id is not null");
    $this->db->select('*');
		$this->db->join('pengajar', 'pengajar.pengajar_id = login.pengajar_id','on');
    $query = $this->db->get('login');
    $this->db->last_query();
		return $query;
	}

  function selectsebagaisiswa(){
		$query = $this->db->query("select login_id, username, password, siswa_id FROM login WHERE siswa_id is not null");
    $this->db->select('*');
		$this->db->join('siswa', 'siswa.siswa_id = login.siswa_id','on');
    $query = $this->db->get('login');
    $this->db->last_query();
    return $query;
	}

  function selectadmin(){
      $query = $this->db->query("select * from admin");
      return $query;
    }

    function selectpengajar(){
        $query = $this->db->query("select * from pengajar");
        return $query;
      }

  function selectsiswa(){
			$query = $this->db->query("select * from siswa");
			return $query;
	}

	function insertuser(){
		$username=$this->input->post("id_username");
    $password=$this->input->post("id_password1");
    $admin=$this->input->post("id_admin");
    $pengajar=$this->input->post("id_pengajar");
		$siswa=$this->input->post("id_siswa");
		$level=$this->input->post("id_usrlevel");
		$datalogin=array(
			'username' => $username,
      'password' => $password,
      'admin_id' => $admin,
      'pengajar_id' => $pengajar,
			'siswa_id' => $siswa,
			'level' => $level
		);
		echo $username;
		$this->db->insert('login', $datalogin);
	}

	function selectedituser(){
		$id_list_user=$this->input->post('id_list_user');
		$query= $this->db->query("select * from login where login_id='$id_list_user'");
		return $query;
	}

	function edituseradmin(){
		$login_id=$this->input->post("id_login");
		$username=$this->input->post("id_username");
    $password=$this->input->post("id_password1");
		$admin=$this->input->post("id_admin");
		$level=$this->input->post("id_usrlevel");
		$datalogin=array(
			'login_id' => $login_id,
			'username' => $username,
			'password' => $password,
			'admin_id' => $admin,
			'level' => $level
		);
		$this->db->where('login_id', $login_id);
		$this->db->update('login', $datalogin);
		// echo $this->db->last_query();
	}

	function edituserpengajar(){
		$login_id=$this->input->post("id_login");
		$username=$this->input->post("id_username");
		$password=$this->input->post("id_password1");
		$pengajar=$this->input->post("id_pengajar");
		$level=$this->input->post("id_usrlevel");
		$datalogin=array(
			'login_id' => $login_id,
			'username' => $username,
			'password' => $password,
			'pengajar_id' => $pengajar,
			'level' => $level
		);
		$this->db->where('login_id', $login_id);
		$this->db->update('login', $datalogin);
		// echo $this->db->last_query();
	}

	function edituserSiswa(){
		$login_id=$this->input->post("id_login");
		$username=$this->input->post("id_username");
		$password=$this->input->post("id_password1");
		$siswa=$this->input->post("id_siswa");
		$level=$this->input->post("id_usrlevel");
		$datalogin=array(
			'login_id' => $login_id,
			'username' => $username,
			'password' => $password,
			'siswa_id' => $siswa,
			'level' => $level
		);
		$this->db->where('login_id', $login_id);
		$this->db->update('login', $datalogin);
		// echo $this->db->last_query();
	}

	function deleteuser(){
		$id_list_user=$this->input->post("id_list_user");
		$this->db->where('login_id', $id_list_user);
		$this->db->delete('login');
	}

}
?>

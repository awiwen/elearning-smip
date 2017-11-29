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
		$datalogin=array(
			'username' => $username,
      'password' => $password,
      'admin_id' => $admin,
      'pengajar_id' => $pengajar,
			'siswa_id' => $siswa
		);
		echo $username;
		$this->db->insert('login', $datalogin);
	}

	function selectedituser(){
		$id_list_user=$this->input->post('id_list_user');
		$query= $this->db->query("select * from login where login_id='$id_list_user'");
		return $query;
	}

	function editkelas(){
		$username=$this->input->post("id_username");
    $password=$this->input->post("id_password1");
		$datakelas=array(
			'kelas_id' => $ids,
			'nama_kelas' => $namakelas,
			'parent_id' => $parent
		);
		$this->db->where('kelas_id', $ids);
		$this->db->update('kelas', $datakelas);
	}

	function deleteuser(){
		$id_list_user=$this->input->post("id_list_user");
		$this->db->where('login_id', $id_list_user);
		$this->db->delete('login');
	}

}
?>

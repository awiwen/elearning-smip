<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectuser($datauser) {
		$this -> db -> select('*');
		// $this -> db -> from('login');
		$this -> db -> join('siswa','login.siswa_id = siswa.siswa_id','left');
		$this -> db -> join('pengajar','login.pengajar_id = pengajar.pengajar_id','left');
		$this -> db -> join('admin','login.admin_id = admin.admin_id','left');
		$this -> db -> where('username', $datauser['email']);
		$this -> db -> where('password', $datauser['passw']);
		$this -> db -> where("(siswa.status_id = '1' OR pengajar.status_id = '1' OR admin.status_id = '1')");
		$this -> db -> limit(1);
		$query = $this -> db -> get('login');

		// echo $this->db->last_query();
		return $query->num_rows();
	}

	// return record, display in clogin controller
	function selectsession($datauser) {
		$this -> db -> select('*');
		$this -> db -> from('login');
		$this -> db -> where('username', $datauser['email']);
		$this -> db -> where('password', $datauser['passw']);
		$query = $this -> db -> get();
		return $query;
	}
}
?>

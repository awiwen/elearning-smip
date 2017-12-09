<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectuser($datauser) {
		$this -> db -> select('*');
		$this -> db -> from('login');
		$this -> db -> where('username', $datauser['email']);
		$this -> db -> where('password', $datauser['passw']);
		$this -> db -> limit(1);
		$query = $this -> db -> get();
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

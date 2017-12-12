<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clogin extends CI_Controller {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('session');
		$this->load->model('mlogin');
	}

	/* 1. fungsi memanggail halaman login */
	public function index() {
		// get db configuration to show in login page
		$dbconfig = array(
			'host'     => $this->db->hostname,
			'db'       => $this->db->database,
			'user'     => $this->db->username,
			'pass'     => $this->db->password,
		);
		$this->load->view('login', $dbconfig);
	}

	public function auth(){
        ini_set('memory_limit', '128M');
        date_default_timezone_set("Asia/Singapore");
		$datauser=array(
			'email'    =>$this->input->post('email'),
			'passw'    =>$this->input->post('passw')
		);
		$query = $this->mlogin->selectsession($datauser);
		$cek   = $this->mlogin->selectuser($datauser);
		if($cek == 1){
			foreach ($query->result() as $row) {
			    // array untuk session
				$user_sess = array(
					'email'       => $this->input->post('email'),
					'passw'       => $this->input->post('passw'),
					'level'	  	  => $row->level,
					'pengajar_id'	  	  => $row->pengajar_id,
					'siswa_id'	  	  => $row->siswa_id,
					'username'	  	  => $row->username,
					'login_state' => TRUE
				);
				// set session data by array $user_sess
				$this->session->set_userdata($user_sess);
			}
		    echo true;
		} else {
			echo false;
		}
	}

    public function logout() {
		$this->session->sess_destroy();
		redirect('clogin/');
	}
}
?>

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

		$this->load->view('login');
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
					'apptitle' => 'E-PKS',
		            'appver'   => 'SISTEM INFORMASI PERJANJIAN KERJASAMA <Br> PT TELKOMSEL BALI <i>DENGAN PELANGGAN CORPORATE</i> <br> BERBASIS BOOTSRAP',
					'email'       => $this->input->post('email'),
					'passw'       => $this->input->post('passw'),
                    'nama'    	  => $row->nama,
					'level'	  	  => $row->level,
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

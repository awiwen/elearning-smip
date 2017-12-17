<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


/*
    HANDLE SESSION:
        - $this->pageauth->sess_auth(); untuk cek session saja pada halaman, semua level bisa akses pleh admin
				- $this->pageauth->sess_auth_admin(); untuk halaman yg bisa diakses oleh "admin" saja
        - $this->pageauth->sess_auth_pengajar(); untuk halaman yg bisa diakses oleh "pengajar" saja
        - $this->pageauth->sess_auth_siswa(); untuk halaman yg bisa diakses oleh "siswa" saja
*/

class Ctrlpages extends CI_Controller {

	/*function construct*/
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*PAGE ADMIN*/
	public function index() {
		$this->pageauth->sess_auth();
		$level = $this->session->userdata('level');

			if ($level == 'Admin') {
				$data = array (
					'title'		=> 'Dashboard',
					'page'		=> 'pages/dashboard'
				);
			} elseif ($level == 'Pengajar') {
				$data = array (
					'title'		=> 'Dashboard',
					'page'		=> 'pages/dashboard_p'
				);
			} elseif ($level == 'Siswa') {
				$data = array (
					'title'		=> 'Dashboard',
					'page'		=> 'pages/dashboard_s'
				);
			} else {
				echo '<script>alert("User level not recognize")</script>';
			}

		// $data = array (
		// 	'title'		=> 'Dashboard',
		// 	'page'		=> 'pages/dashboard'
		// );

		$this->load->view('wrapper', $data);
	}

	public function help() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Help',
			'page'		=> 'pages/help'
		);
		$this->load->view('wrapper', $data);
	}

	public function pengumuman() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Pengumuman',
			'page'		=> 'pages/vpengumuman'
		);
		$this->load->view('wrapper', $data);
	}

	public function siswa() {
		$this->pageauth->sess_auth();
		$data = array(
            'title'    => 'Halaman Siswa',
            'page'     => 'pages/vsiswa'
        );
        $this->load->view('wrapper', $data);
    }

	public function pengajar() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Pengajar',
			'page'		=> 'pages/vpengajar'
		);

		$this->load->view('wrapper', $data);
	}

	public function tugas() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'tugas',
			'page'		=> 'pages/vtugas'
		);
		$this->load->view('wrapper', $data);
	}

	public function materi() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Materi',
			'page'		=> 'pages/vmateri'
		);
		$this->load->view('wrapper', $data);
	}

	public function mapelkelas() {
		$this->pageauth->sess_auth_admin();
		$data = array (
			'title'		=> 'Matapelajaran Kelas',
			'page'		=> 'pages/vmapel_kelas'
		);
		$this->load->view('wrapper', $data);
	}

	public function kelas_siswa() {
		$this->pageauth->sess_auth_admin();
		$data = array(
	          'title'    => 'Halaman Kelas Siswa',
	          'page'     => 'pages/vkelas_siswa'
	      );
	      $this->load->view('wrapper', $data);
	  }

	public function manakelas() {
		$this->pageauth->sess_auth_admin();
		$data = array (
			'title'		=> 'Manajemen Kelas',
			'page'		=> 'pages/vkelas'
		);
		$this->load->view('wrapper', $data);
	}

	public function manamapel() {
		$this->pageauth->sess_auth_admin();
		$data = array (
			'title'		=> 'Manajemen Matapelajaran',
			'page'		=> 'pages/vmapel'
		);
		$this->load->view('wrapper', $data);
	}

	public function manauser() {
		$this->pageauth->sess_auth_admin();
		$data = array (
			'title'		=> 'user',
			'page'		=> 'pages/vuser'
		);
		$this->load->view('wrapper', $data);
	}

	/*PAGE Pengajar*/

	public function index_p() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Dashboard',
			'page'		=> 'pages/dashboard_p'
		);

		$this->load->view('wrapper', $data);
	}

	public function pengumuman_p() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Pengumuman',
			'page'		=> 'pages/vpengumuman_p'
		);
		$this->load->view('wrapper', $data);
	}

	public function siswa_p() {
		$this->pageauth->sess_auth();
		$data = array(
						'title'    => 'Halaman Siswa',
						'page'     => 'pages/vsiswa_p'
				);
				$this->load->view('wrapper', $data);
		}

	public function pengajar_p() {
		$this->pageauth->sess_auth();
		$data = array(
						'title'    => 'Halaman Pengajar',
						'page'     => 'pages/vpengajar_p'
				);
				$this->load->view('wrapper', $data);
		}

	public function tugas_p() {
		$this->pageauth->sess_auth();
		$data = array(
						'title'    => 'Halaman Tugas',
						'page'     => 'pages/vtugas_p'
				);
				$this->load->view('wrapper', $data);
		}

	public function materi_p() {
		$this->pageauth->sess_auth();
		$data = array (
			'title'		=> 'Materi',
			'page'		=> 'pages/vmateri_p'
		);
		$this->load->view('wrapper', $data);
	}

/* MENU SISWA */
	public function tugas_s() {
		$this->pageauth->sess_auth();
		$data = array(
						'title'    => 'Halaman Tugas',
						'page'     => 'pages/vtugas_s'
				);
				$this->load->view('wrapper', $data);
		}

	public function materi_s() {
		$this->pageauth->sess_auth();
		$data = array(
						'title'    => 'Halaman Materi',
						'page'     => 'pages/vmateri_s'
				);
				$this->load->view('wrapper', $data);
		}

}
?>

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrlpages extends CI_Controller {

	/*function construct*/
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*Other page*/
	public function index() {
		$data = array (
			'title'		=> 'Dashboard',
			'page'		=> 'pages/dashboard'
		);

	//			$this->load->model('jadhari');
  //      $data['jadwal'] = 'Menampilkan jadwal pelajaran hari ini';
  //      $data['jadwal_hari'] = $this->jadhari->get_jadwal_all();
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	/* halaman siswa */
    public function halsiswa(){
        $data = array(
            'title'    => 'Halaman Siswa',
            'page'     => 'pages/vsiswa'
        );
        $this->load->view('wrapper', $data);
    }

	public function help() {
		$data = array (
			'title'		=> 'Help',
			'page'		=> 'pages/help'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function pengumuman() {
		$data = array (
			'title'		=> 'Pengumuman',
			'page'		=> 'pages/vpengumuman'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function backup() {
		$data = array (
			'title'		=> 'Backup & Restore',
			'page'		=> 'pages/backup'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function hapus() {
		$data = array (
			'title'		=> 'hapus data',
			'page'		=> 'pages/hapus'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function kmateri() {
		$data = array (
			'title'		=> 'Komentar Materi',
			'page'		=> 'pages/kmateri'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function manakelas() {
		$data = array (
			'title'		=> 'Manajemen Kelas',
			'page'		=> 'pages/vkelas'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function manamapel() {
		$data = array (
			'title'		=> 'Manajemen Matapelajaran',
			'page'		=> 'pages/vmapel'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function mapelkelas() {
		$data = array (
			'title'		=> 'Matapelajaran Kelas',
			'page'		=> 'pages/vmapel_kelas'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function materi() {
		$data = array (
			'title'		=> 'Materi',
			'page'		=> 'pages/vmateri'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}




	public function pengaturan() {
		$data = array (
			'title'		=> 'Pengaturan',
			'page'		=> 'pages/pengaturan'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function tugas() {
		$data = array (
			'title'		=> 'tugas',
			'page'		=> 'pages/vtugas'
		);
//		$this->pageauth->sess_auth();
//		$this->load->model('m_agrowisata');
		$this->load->view('wrapper', $data);
	}

	public function pengajar() {
		$data = array (
			'title'		=> 'Pengajar',
			'page'		=> 'pages/vpengajar'
		);

		$this->load->view('wrapper', $data);
	}

	public function siswa() {
		$data = array(
            'title'    => 'Halaman Siswa',
            'page'     => 'pages/vsiswa'
        );
        $this->load->view('wrapper', $data);
    }

	public function kelas_siswa() {
		$data = array(
	          'title'    => 'Halaman Kelas Siswa',
	          'page'     => 'pages/vkelas_siswa'
	      );
	      $this->load->view('wrapper', $data);
	  }


	public function tb_siswa() {
		$data = array (
			'title'		=> 'Siswa',
			'page'		=> 'pages/tb_siswa'
		);

		//$this->load->view(’siswa’,$data);

		$this->load->view('wrapper', $data);
	}

	public function detailsiswa() {
		$data = array (
			'title'		=> 'detailsiswa',
			'page'		=> 'pages/vdsiswa'
		);


		$this->load->view('wrapper', $data);
	}


	/*public function show_about() {
		$data = array (
			'title' 	=> 'Tentang Aplikasi',
			'page'		=> 'pages/show_about'
		);
		$this->pageauth->sess_auth();
		$this->load->view('wrapper', $data);
	}*/

}
?>

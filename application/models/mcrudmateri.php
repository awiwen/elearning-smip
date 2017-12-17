<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmateri extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectParent(){
		$query = $this->db->query("select * from kelas where parent_id is null");
		return $query;
	}

	function selectkelas($kelas_id){
		$query = $this->db->query("select * from kelas where parent_id = '".$kelas_id."'");
		return $query;
	}

	function showmapel($kelas_id = null){
		$this->db->select("*");
		$this->db->join('mapel', 'mapel.mapel_id = mapel_kelas.mapel_id','right');
		$this->db->where("mapel_kelas.kelas_id",$kelas_id);
		$query = $this->db->get("mapel_kelas");
		$this->db->last_query();
		return $query;
	}

	function showmateri($mapel_id = null,$kelas_id = null ){
			$this->db->select("*");
			$this->db->join('materi_kelas', 'materi.materi_id = materi_kelas.materi_id','left');
			$this->db->where("materi.mapel_id",$mapel_id);
			$this->db->where("materi_kelas.kelas_id",$kelas_id);
			$query = $this->db->get("materi");
			return $query;
		}

	function showmateri_p($mapel_id = null,$kelas_id = null,$pengajar_id ){
			$this->db->select("*");
			$this->db->join('materi_kelas', 'materi.materi_id = materi_kelas.materi_id','left');
			$this->db->where("materi.mapel_id",$mapel_id);
			$this->db->where("materi_kelas.kelas_id",$kelas_id);
			$this->db->where("pengajar_id",$pengajar_id);
			$query = $this->db->get("materi");
			$this->db->last_query();
			return $query;
		}

	function showkomentar($materi_id = null){
			$this->db->select("*");
			$this->db->join('komentar_materi', 'login.login_id = komentar_materi.login_id','on');
			$this->db->where("komentar_materi.materi_id",$materi_id);
			$query = $this->db->get("login");
			$this->db->last_query();
			return $query;
		}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}

	function selectmapeledit($mapel_id){
			$query = $this->db->query("select * from mapel");
			return $query;
		}

	function selectpengajar(){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}
	function selectloginkomentar(){
			$query = $this->db->query("select * from login");
			return $query;
		}

	function selectloginkomentar_p(){
			$query = $this->db->query("select * from login");
			return $query;
		}

	function selectpengajaredit($pengajar_id){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}

	function selectkelasadd(){
			$query = $this->db->query("select * from kelas where parent_id is not null");
			return $query;
		}

		function selectkelasedit($kelas_id){
				$query = $this->db->query("select * from kelas where parent_id is not null");
				return $query;
			}

	function selectmaterix(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();
		return $query;
	}

	function selectmateri(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function insertmateri(){
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten");
		$tposting=$this->input->post("id_tposting");
		$mapel=$this->input->post("id_mapel");
		$pengajar=$this->input->post("id_pengajar");
		$kelas=$this->input->post("id_kelas");
		$datamateri=array(
			'judul' => $judul,
			'konten' => $konten,
			'tgl_posting' => $tposting,
			'mapel_id' => $mapel,
			'pengajar_id' => $pengajar
		);
		$this->db->insert('materi', $datamateri);
		$materi_id = $this->db->insert_id();
		$this->db->last_query();

		$datamaterikelas=array(
			'materi_id' => $materi_id,
			'kelas_id' => $kelas
		);
		$this->db->insert('materi_kelas', $datamaterikelas);
		$this->db->last_query();
	}

	// function insertkelas(){
	//
	// echo $kelas=$this->input->post("id_kelas");
	// 	$datakelas=array(
	// 		'materi_id' => '2424',
	// 		'kelas_id' => $kelas
	// 	);
	// 	$this->db->insert('materi_kelas', $datakelas);
	// }

	function selectdetailmateri(){
		$id_list_materi=$this->input->post('id_list_materi');
		$query= $this->db->query("select * from materi where materi_id='$id_list_materi'");
		$this->db->last_query();
		return $query;
	}

	function selectkomentar(){
		$id_list_komentar=$this->input->post('id_list_komentar');
		$query= $this->db->query("select * from komentar_materi where komentar_id='$id_list_komentar'");
		$this->db->last_query();
		return $query;
	}

	function selecteditmateri(){
		$id_list_materi=$this->input->post('id_list_materi');
		$query= $this->db->query("select * from materi where materi_id='$id_list_materi'");
		return $query;
	}

	function editmateri(){
		$materi_id=$this->input->post("id_materi_id");
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten2");
		$tposting=$this->input->post("id_tposting");
		$mapel=$this->input->post("id_mapel");
		$pengajar=$this->input->post("id_pengajar");
		$kelas=$this->input->post("id_kelas");
		$datamateri=array(
			'materi_id'=> $materi_id,
			'judul' => $judul,
			'konten' => $konten,
			'tgl_posting' => $tposting,
			'mapel_id' => $mapel,
			'pengajar_id' => $pengajar
		);

		$this->db->where('materi_id', $materi_id);
		$this->db->update('materi', $datamateri);

		$this->db->last_query();

		$datamaterikelas=array(
			'materi_id' => $materi_id,
			'kelas_id' => $kelas
		);
		$this->db->where('materi_id', $materi_id);
		$this->db->update('materi_kelas', $datamaterikelas);

		$this->db->last_query();

//		$this->db->insert('materi_kelas', $datamaterikelas);
	}

	function deletemateri(){
		$id_list_materi=$this->input->post("id_list_materi");
		$this->db->where('materi_id', $id_list_materi);
		$this->db->delete('materi');
	}

	function deletekomentar(){
		$id_list_komentar=$this->input->post("id_list_komentar");
		$this->db->where('komentar_id', $id_list_komentar);
		$this->db->delete('komentar_materi');
	}

	function selectmateriup(){
		$materiup=$this->input->post('materi_id');
		$query= $this->db->query("select * from materi where materi_id='$materiup'");
		return $query;
	}

	function insertkomentar(){
			$materi_id=$this->input->post("id_materi_id");
			$tposting=$this->input->post("id_tposting");
			$login=$this->input->post("id_login");
			$konten=$this->input->post("id_konten");
			$datakomentar=array(
				'materi_id' => $materi_id,
				'tgl_posting' => $tposting,
				'login_id' => $login,
				'konten' => $konten

			);
			$this->db->insert('komentar_materi',$datakomentar);
			$komentar_materi_id = $this->db->insert_id();
			$this->db->last_query();
		}
}
?>

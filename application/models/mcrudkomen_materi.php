<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkomen_materi extends CI_Model {

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

	function showmateri($mapel_id = null){
			$this->db->select("*");
			$this->db->where("mapel_id",$mapel_id);
			$query = $this->db->get("materi");
			return $query;
		}

		function showkomen_materi($materi_id = null){
				$this->db->select("*");
				$this->db->where("materi_id",$materi_id);
				$query = $this->db->get("komentar_materi");
				return $query;
			}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}

	function selectpengajar(){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}

		function selectloginadd(){
				$query = $this->db->query("select * from login");
				return $query;
			}

	function selectmateriadd(){
			$query = $this->db->query("select * from materi");
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


	function insertkomen_materi(){

		$login=$this->input->post("id_login");
		$materi=$this->input->post("id_materi");
		$konten=$this->input->post("id_konten");
		$tposting = date("Y-m-d H:i:s");
		$datakomen_materi=array(
			'login_id' => $login,
			'materi_id' => $materi,
			'konten' => $konten,
			'tgl_posting' => $tposting
		);
		$this->db->insert('komentar_materi', $datakomen_materi);
		$id_komen_materi = $this->db->insert_id();

		// $datakomen_materi_kelas=array(
		// 	'komen_materi_id' => $id_komen_materi,
		// 	'kelas_id' => $kelas
		// );
		// $this->db->insert('komen_materi_kelas', $datakomen_materi_kelas);
	}

	function deletekomen_materi(){
		$id_list_komen_materi=$this->input->post("id_list_komen_materi");
		$this->db->where('komentar_id', $id_list_komen_materi);
		$this->db->delete('komentar_materi');
	}

}
?>

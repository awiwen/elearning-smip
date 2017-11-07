<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkelas_siswa extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function showkelas_siswa($kelas_id = null){
		$this->db->select("*");
		$this->db->join('mapel', 'mapel.mapel_id = kelas_siswa.mapel_id','right');
		$this->db->where("kelas_siswa.kelas_id",$kelas_id);
		$query = $this->db->get("kelas_siswa");
		$this->db->last_query();

		return $query;
	}

	function selectkelas_siswax(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM kelas_siswa WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = kelas_siswa.mapel_id','right');
		$query = $this->db->get('kelas_siswa');
		$this->db->last_query();

		return $query;
	}

	function selectkelas_siswa(){
		$query = $this->db->query("select * from kelas_siswa");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from kelas_siswa");
		return $query;
	}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}
	function selectkelas($kelas_id){
			$query = $this->db->query("select * from kelas");
			return $query;
		}

	function insertkelas_siswa(){

		$mapel=$this->input->post("id_mapel");
		$kelas=$this->input->post("id_kelas");
		$status=$this->input->post("id_status");
		$datakelas_siswa=array(
			'mapel_id' => $mapel,
			'kelas_id' => $kelas
		);
		$this->db->insert('kelas_siswa', $datakelas_siswa);
	}

	function selecteditkelas_siswa(){
		$id_list_kelas_siswa=$this->input->post('id_list_kelas_siswa');
		$query= $this->db->query("select * from kelas_siswa where id='$id_list_kelas_siswa'");
		return $query;
	}

	function editkelas_siswa(){
		$idmapelkelas=$this->input->post("id_mapelkelas");
		$mapel=$this->input->post("id_mapel");
		$kelas=$this->input->post("id_kelas");
		$datakelas_siswa=array(
			'id' => $idmapelkelas,
			'mapel_id' => $mapel,
			'kelas_id' => $kelas
		);
		$this->db->where('id', $idmapelkelas);
		$this->db->update('kelas_siswa', $datakelas_siswa);
	}

	function deletekelas_siswa(){
		$id_list_kelas_siswa=$this->input->post("id_list_kelas_siswa");
		$this->db->where('id', $id_list_kelas_siswa);
		$this->db->delete('kelas_siswa');
	}

}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmapel_kelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function showmapel_kelas($kelas_id = null){
		$this->db->select("*");
		$this->db->join('mapel', 'mapel.mapel_id = mapel_kelas.mapel_id','right');
		$this->db->where("mapel_kelas.kelas_id",$kelas_id);
		$query = $this->db->get("mapel_kelas");
		$this->db->last_query();

		return $query;
	}

	function selectmapel_kelasx(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();

		return $query;
	}

	function selectmapel_kelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}
	function selectkelas($kelas_id){
			$query = $this->db->query("select * from kelas where parent_id is not null");
			return $query;
		}

	function insertmapel_kelas(){

		$mapel=$this->input->post("id_mapel");
		$kelas=$this->input->post("id_kelas");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(
			'mapel_id' => $mapel,
			'kelas_id' => $kelas
		);
		$this->db->insert('mapel_kelas', $datamapel_kelas);
	}

	function selecteditmapel_kelas(){
		$id_list_mapel_kelas=$this->input->post('id_list_mapel_kelas');
		$query= $this->db->query("select * from mapel_kelas where id='$id_list_mapel_kelas'");
		return $query;
	}

	function editmapel_kelas(){
		$idmapelkelas=$this->input->post("id_mapelkelas");
		$mapel=$this->input->post("id_mapel");
		$kelas=$this->input->post("id_kelas");
		$datamapel_kelas=array(
			'id' => $idmapelkelas,
			'mapel_id' => $mapel,
			'kelas_id' => $kelas
		);
		$this->db->where('id', $idmapelkelas);
		$this->db->update('mapel_kelas', $datamapel_kelas);
	}

	function deletemapel_kelas(){
		$id_list_mapel_kelas=$this->input->post("id_list_mapel_kelas");
		$this->db->where('id', $id_list_mapel_kelas);
		$this->db->delete('mapel_kelas');
	}

}
?>

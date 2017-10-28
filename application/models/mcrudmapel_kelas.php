<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmapel_kelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function showmapel_kelas($kelas_id = null){
		$this->db->select("*");
		$this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id','right');
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

	function insertmapel_kelas(){

		$namamapel_kelas=$this->input->post("id_namamapel_kelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(
			'nama_mapel_kelas' => $namamapel_kelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->insert('mapel_kelas', $datamapel_kelas);
	}

	function selecteditmapel_kelas(){
		$id_list_mapel_kelas=$this->input->post('id_list_mapel_kelas');
		$query= $this->db->query("select * from mapel_kelas where id='$id_list_mapel_kelas'");
		return $query;
	}

	function editmapel_kelas(){
		$ids=$this->input->post("id_mapel_kelas");
		$namamapel_kelas=$this->input->post("id_namamapel_kelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(
			'id' => $ids,
			'nama_mapel_kelas' => $namamapel_kelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->where('id', $ids);
		$this->db->update('mapel_kelas', $datamapel_kelas);
	}

	function deletemapel_kelas(){
		$id_list_mapel_kelas=$this->input->post("id_list_mapel_kelas");
		$this->db->where('id', $id_list_mapel_kelas);
		$this->db->delete('mapel_kelas');
	}

}
?>

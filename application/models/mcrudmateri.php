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

	function showmateri($kelas_id = null){
			$this->db->select("*");
			$this->db->join('materi', 'materi.materi_id = materi_kelas.materi_id','right');
			$this->db->where("materi_kelas.kelas_id",$kelas_id);
			$query = $this->db->get("materi_kelas");
			$this->db->last_query();
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

		$namamateri=$this->input->post("id_namamapel_kelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(
			'nama_mapel_kelas' => $namamapel_kelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->insert('mapel_kelas', $datamapel_kelas);
	}

	function selecteditmateri(){
		$id_list_mapel_kelas=$this->input->post('id_list_mapel_kelas');
		$query= $this->db->query("select * from mapel_kelas where id='$id_list_mapel_kelas'");
		return $query;
	}

	function editmateri(){
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

	function deletemateri(){
		$id_list_mapel_kelas=$this->input->post("id_list_mapel_kelas");
		$this->db->where('id', $id_list_mapel_kelas);
		$this->db->delete('mapel_kelas');
	}

}
?>

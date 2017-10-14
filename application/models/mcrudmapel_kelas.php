<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mcrudmapel_kelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectmapel_kelasparentx(){
		$query = $this->db->query("select id, nama_mapel_kelas, status_id FROM mapel_kelas WHERE parent_id='x'");
		return $query;
	}

	function selectmapel_kelasparentxi(){
		$query = $this->db->query("select id, nama_mapel_kelas, status_id FROM mapel_kelas WHERE parent_id='xi'");
		return $query;
	}

	function selectmapel_kelasparentxii(){
			$query = $this->db->query("select id, nama_mapel_kelas, status_id FROM mapel_kelas WHERE parent_id='xii'");
			return $query;
		}

	function selectmapel_kelas(){
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
		$parent_id=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(

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

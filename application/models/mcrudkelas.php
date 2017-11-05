<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectkelasparentx(){
		$query = $this->db->query("select kelas_id, nama_kelas, status_id FROM kelas WHERE parent_id='1'");
		return $query;
	}

	function selectkelasparentxi(){
		$query = $this->db->query("select kelas_id, nama_kelas, status_id FROM kelas WHERE parent_id='6'");
		return $query;
	}

	function selectkelasparentxii(){
			$query = $this->db->query("select kelas_id, nama_kelas, status_id FROM kelas WHERE parent_id='11'");
			return $query;
		}

	function selectkelas($id){
		$query = $this->db->query("select * from kelas where parent_id = '".$id."'");
		return $query;
	}

	function selectmapel($id){
		$query = $this->db->query("select * from mapel_kelas where kelas_id = '".$id."'");
		return $query;
	}

	function selectParent(){
		$query = $this->db->query("select * from kelas where parent_id is null");
		return $query;
	}

	function insertkelas(){

		$namakelas=$this->input->post("id_namakelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datakelas=array(
			'nama_kelas' => $namakelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->insert('kelas', $datakelas);
	}

	function selecteditkelas(){
		$id_list_kelas=$this->input->post('id_list_kelas');
		$query= $this->db->query("select * from kelas where kelas_id='$id_list_kelas'");
		return $query;
	}

	function editkelas(){
		$ids=$this->input->post("id_kelas");
		$namakelas=$this->input->post("id_namakelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datakelas=array(
			'kelas_id' => $ids,
			'nama_kelas' => $namakelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->where('kelas_id', $ids);
		$this->db->update('kelas', $datakelas);
	}

	function deletekelas(){
		$id_list_kelas=$this->input->post("id_list_kelas");
		$this->db->where('kelas_id', $id_list_kelas);
		$this->db->delete('kelas');
	}

}
?>

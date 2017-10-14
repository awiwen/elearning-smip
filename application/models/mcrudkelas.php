<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectkelasparentx(){
		$query = $this->db->query("select id, nama_kelas, status_id FROM kelas WHERE parent_id='x'");
		return $query;
	}

	function selectkelasparentxi(){
		$query = $this->db->query("select id, nama_kelas, status_id FROM kelas WHERE parent_id='xi'");
		return $query;
	}

	function selectkelasparentxii(){
			$query = $this->db->query("select id, nama_kelas, status_id FROM kelas WHERE parent_id='xii'");
			return $query;
		}

	function selectkelas(){
		$query = $this->db->query("select * from kelas");
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
		$query= $this->db->query("select * from kelas where id='$id_list_kelas'");
		return $query;
	}

	function editkelas(){
		$ids=$this->input->post("id_kelas");
		$namakelas=$this->input->post("id_namakelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datakelas=array(
			'id' => $ids,
			'nama_kelas' => $namakelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->where('id', $ids);
		$this->db->update('kelas', $datakelas);
	}

	function deletekelas(){
		$id_list_kelas=$this->input->post("id_list_kelas");
		$this->db->where('id', $id_list_kelas);
		$this->db->delete('kelas');
	}

}
?>

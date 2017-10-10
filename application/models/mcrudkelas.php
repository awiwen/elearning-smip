<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectkelas(){
		$query = $this->db->query("select * from kelas");
		return $query;
	}

	function insertkelas(){

		$nama=$this->input->post("id_nama");
		$parent=$this->input->post("id_parent");
		$aktif=$this->input->post("id_aktif");;
		$datappn=array(
			'nama' => $nama,
			'parent_id' => $parent,
			'aktif' => $aktif,
		);
		$this->db->insert('kelas', $datakelas);
	}

}
?>

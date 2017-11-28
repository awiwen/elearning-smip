<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmapel extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectmapel(){
		 $query = $this->db->query("select * from mapel");
		$this->db->last_query();
		return $query;
	}

	function insertmapel(){

		$id=$this->input->post("id_mapel");
		$namamapel=$this->input->post("id_namamapel");
		$datamapel=array(
			'mapel_id' => $id,
			'nama_mapel' => $namamapel
		);
	//print_r($agama);
	$this->db->insert('mapel', $datamapel);
	}

	function selecteditmapel(){
		$id_list_mapel=$this->input->post('id_list_mapel');
		$query= $this->db->query("select * from mapel where mapel_id='$id_list_mapel'");
		return $query;
	}

	function editmapel(){
    $id=$this->input->post("id_mapel");
		$namamapel=$this->input->post("id_namamapel");
		$datamapel=array(
      'mapel_id' => $id,
			'nama_mapel' => $namamapel
		);
		$this->db->where('mapel_id', $id);
		$this->db->update('mapel', $datamapel);
	}

	function deletemapel(){
		$id_list_mapel=$this->input->post("id_list_mapel");
		$this->db->where('mapel_id', $id_list_mapel);
		$this->db->delete('mapel');
	}

}
?>

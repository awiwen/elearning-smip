<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmapel extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectmapel(){
		 $query = $this->db->query("select * from mapel");
		$this->db->select('*');
		$this->db->join('status', 'status.status_id = mapel.status_id','LEFT');
		$query = $this->db->get('mapel');
		$this->db->last_query();
		return $query;
	}

	function insertmapel(){

		$id=$this->input->post("id_mapel");
		$namamapel=$this->input->post("id_namamapel");
		$info=$this->input->post("id_info");

		$status=$this->input->post("id_status");
		$datamapel=array(
			'mapel_id' => $id,
			'nama_mapel' => $namamapel,
			'info' => $info,
			'status_id' => $status
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
    $info=$this->input->post("id_info");
		$status=$this->input->post("id_status");
		$datamapel=array(
      'mapel_id' => $id,
			'nama_mapel' => $namamapel,
			'info' => $info,
			'status_id' => $status
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

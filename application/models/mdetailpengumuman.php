<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailpengumuman extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

function selectdetailpengumuman(){
  $id_list_pengumuman=$this->input->post('id_list_pengumuman');
  $query= $this->db->query("select * from pengumuman where pengumuman_id='$id_list_pengumuman'");
  return $query;
}
}
?>

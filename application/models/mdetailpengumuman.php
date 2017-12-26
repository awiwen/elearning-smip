<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailpengumuman extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

function selectdetailpengumuman($pengumuman_id){
  $query= $this->db->query("select * from pengumuman where pengumuman_id='$pengumuman_id'");
	$this->db->last_query();
  return $query;
}
}
?>

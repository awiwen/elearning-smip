<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailpengumuman extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

function selectdetailpengumuman($pengumuman_id){
  $query= $this->db->query("select `pengumuman_id`,`judul`,`konten`,`file`,
																	DATE_FORMAT(`tgl_tampil`, '%d %M %Y') AS `tgl_tam`,
																	DATE_FORMAT(`tgl_tutup`, '%d %M %Y') AS `tgl_tut` FROM `pengumuman`
																	WHERE `pengumuman`.`pengumuman_id`='$pengumuman_id'");
	// echo $this->db->last_query();
  return $query;
}
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailmateri extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function selectdetailmateri($materi_id){
    // $id_list_materi=$this->input->post('id_list_materi');
    $this->db->select("*");
    // $this->db->join('materi_kelas', 'materi.materi_id = materi_kelas.materi_id','right');
    $this->db->join('pengajar', 'pengajar.pengajar_id = materi.pengajar_id','right');
    $this->db->join('kelas', 'materi.kelas_id = kelas.kelas_id','right');
    $this->db->join('mapel', 'materi.mapel_id = mapel.mapel_id','right');
    $this->db->where("materi.materi_id",$materi_id);
    $query = $this->db->get('materi');
    $this->db->last_query();
    // $query= $this->db->query("select * from materi where materi_id='$id_list_materi'");
     return $query;
  }
//
// function selectdetailmateri($materi_id){
//   $query= $this->db->query("select * from materi where materi_id='$materi_id'");
// 	echo $this->db->last_query();
//   return $query;
// }
}
?>

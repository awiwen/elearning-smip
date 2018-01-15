<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailtugas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function selectdetailtugas($tugas_id){
    // $id_list_tugas=$this->input->post('id_list_tugas');
    $this->db->select("*");
    $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','right');
    $this->db->join('pengajar', 'pengajar.pengajar_id = tugas.pengajar_id','right');
    $this->db->join('kelas', 'tugas_kelas.kelas_id = kelas.kelas_id','right');
    $this->db->join('mapel', 'tugas.mapel_id = mapel.mapel_id','right');
    $this->db->where("tugas.tugas_id",$tugas_id);
    $query = $this->db->get('tugas');
    $this->db->last_query();
    // $query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
     return $query;
  }

	function showjawaban($id){
			$this->db->select("*");
			$this->db->join('tugas_jawaban', 'siswa.siswa_id = tugas_jawaban.siswa_id','on');
			$this->db->where("tugas_jawaban.tugas_id",$id);
			$query = $this->db->get("siswa");
			// echo $this->db->last_query();
			return $query;
		}
//
// function selectdetailtugas($tugas_id){
//   $query= $this->db->query("select * from tugas where tugas_id='$tugas_id'");
// 	echo $this->db->last_query();
//   return $query;
// }
}
?>

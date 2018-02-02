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
    // $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','right');
    $this->db->join('pengajar', 'pengajar.pengajar_id = tugas.pengajar_id','right');
    $this->db->join('kelas', 'tugas.kelas_id = kelas.kelas_id','right');
    $this->db->join('mapel', 'tugas.mapel_id = mapel.mapel_id','right');
    $this->db->where("tugas.tugas_id",$tugas_id);
    $query = $this->db->get('tugas');
    // $this->db->last_query();
    // $query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
     return $query;
  }
//
// function selectdetailtugas($tugas_id){
//   $query= $this->db->query("select * from tugas where tugas_id='$tugas_id'");
// 	echo $this->db->last_query();
//   return $query;
// }

function selectdetailjawab($id_list_jawaban){
	// $id_list_jawaban=$this->input->post('id_list_jawaban');
	$query= $this->db->query("select *, tugas_jawaban.konten as konten_jawaban ,
														tugas_jawaban.file AS file_jawaban ,
	   												tugas_jawaban.tgl_buat AS tgl_jawaban from tugas_jawaban
														left join tugas on tugas_jawaban.tugas_id=tugas.tugas_id
														left join siswa on tugas_jawaban.siswa_id=siswa.siswa_id
														LEFT JOIN mapel ON tugas.mapel_id=mapel.mapel_id
														where tugas_jawaban_id='$id_list_jawaban'");
	// echo $this->db->last_query();
	return $query;
}
}
?>

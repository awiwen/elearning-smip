<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudpengajar extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectpengajar(){
		$query = $this->db->query("select * from pengajar");
		return $query;
	}

	function insertpengajar(){

		$nip=$this->input->post("id_nip");
		$nama=$this->input->post("id_nama");
		$jk=$this->input->post("id_jk");
		$tel=$this->input->post("id_tel");
		$alamat=$this->input->post("id_alamat");
		$status=$this->input->post("id_status");
		$datappn=array(
			'nip' => $nip,
			'nama' => $nama,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $el,
			'alamat' => $alamat,
			'status_id' => $status,

		);
		$this->db->insert('pengajar', $datapengajar);
	}

}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmateri extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectmateri(){
		$query = $this->db->query("select * from materi");
	 //	$this->db->select('*');
	 //	$this->db->join('status', 'status.status_id = materi.tampil_siswa', 'status.status_id = materi.tampil_materi','LEFT');
	 //	$query = $this->db->get('materi');
	 	$this->db->last_query();
	 return $query;
	}

	function insertmateri(){

		$judul				=$this->input->post("id_judul");
		$konten				=$this->input->post("id_konten");
		$tgltampil		=$this->input->post("id_ttampil");
		$tgltutup			=$this->input->post("id_ttutup");
		$tamsiswa			=$this->input->post("id_asiswa");
		$tampengajar	=$this->input->post("id_apengajar");
		$datamateri=array(
			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
	//print_r($agama);
	$this->db->insert('materi', $datamateri);
	}

	function selecteditmateri(){
		$id_list_materi=$this->input->post('id');
		$query= $this->db->query("select * from materi where id='$id_list_materi'");
		return $query;
	}

	function selectdetailmateri(){
		$id_list_materi=$this->input->post('id_list_materi');
		$query= $this->db->query("select * from materi where id='$id_list_materi'");
		return $query;
	}

	function editmateri(){
		$id_peng = $this->input->post('id_peng');
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten2");
		$tgltampil=$this->input->post("id_ttampil");
		$tgltutup=$this->input->post("id_ttutup");
		$tamsiswa=$this->input->post("id_asiswa");
		$tampengajar=$this->input->post("id_apengajar");
		$datamateri=array(

			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
		$this->db->where('id', $id_peng);
		$this->db->update('materi', $datamateri);
	}

	function deletemateri(){
		$id_list_materi=$this->input->post("id_list_materi");
		$this->db->where('id', $id_list_materi);
		$this->db->delete('materi');
	}

}
?>

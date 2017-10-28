<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudtugas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selecttugas(){
		$query = $this->db->query("select * from tugas");
	 	$this->db->select('*');
	 	$this->db->join('status', 'status.status_id = tugas.tampil_siswa', 'status.status_id = tugas.tampil_tugas','LEFT');
	 	$query = $this->db->get('tugas');
	 	$this->db->last_query();
	 return $query;
	}

	function inserttugas(){

		$judul				=$this->input->post("id_judul");
		$konten				=$this->input->post("id_konten");
		$tgltampil		=$this->input->post("id_ttampil");
		$tgltutup			=$this->input->post("id_ttutup");
		$tamsiswa			=$this->input->post("id_asiswa");
		$tampengajar	=$this->input->post("id_apengajar");
		$datatugas=array(
			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
	//print_r($agama);
	$this->db->insert('tugas', $datatugas);
	}

	function selectedittugas(){
		$id_list_tugas=$this->input->post('id');
		$query= $this->db->query("select * from tugas where id='$id_list_tugas'");
		return $query;
	}

	function selectdetailtugas(){
		$id_list_tugas=$this->input->post('id_list_tugas');
		$query= $this->db->query("select * from tugas where id='$id_list_tugas'");
		return $query;
	}

	function edittugas(){
		$id_peng = $this->input->post('id_peng');
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten2");
		$tgltampil=$this->input->post("id_ttampil");
		$tgltutup=$this->input->post("id_ttutup");
		$tamsiswa=$this->input->post("id_asiswa");
		$tampengajar=$this->input->post("id_apengajar");
		$datatugas=array(

			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
		$this->db->where('id', $id_peng);
		$this->db->update('tugas', $datatugas);
	}

	function deletetugas(){
		$id_list_tugas=$this->input->post("id_list_tugas");
		$this->db->where('id', $id_list_tugas);
		$this->db->delete('tugas');
	}

}
?>

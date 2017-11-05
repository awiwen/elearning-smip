<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudpengumuman extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectpengumuman(){
		$query = $this->db->query("select * from pengumuman");
	 	$this->db->select('*');
	 	$this->db->join('status', 'status.status_id = pengumuman.tampil_siswa', 'status.status_id = pengumuman.tampil_pengumuman','LEFT');
	 	$query = $this->db->get('pengumuman');
	 	$this->db->last_query();
	 return $query;
	}

	function insertpengumuman(){

		$judul				=$this->input->post("id_judul");
		$konten				=$this->input->post("id_konten");
		$tgltampil		=$this->input->post("id_ttampil");
		$tgltutup			=$this->input->post("id_ttutup");
		$tamsiswa			=$this->input->post("id_asiswa");
		$tampengajar	=$this->input->post("id_apengajar");
		$datapengumuman=array(
			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
	//print_r($agama);
	$this->db->insert('pengumuman', $datapengumuman);
	}

	function selecteditpengumuman(){
		$id_list_pengumuman=$this->input->post('id');
		$query= $this->db->query("select * from pengumuman where pengumuman_id='$id_list_pengumuman'");
		return $query;
	}

	function selectdetailpengumuman(){
		$id_list_pengumuman=$this->input->post('id_list_pengumuman');
		$query= $this->db->query("select * from pengumuman where pengumuman_id='$id_list_pengumuman'");
		return $query;
	}

	function editpengumuman(){
		$id_peng = $this->input->post('id_peng');
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten2");
		$tgltampil=$this->input->post("id_ttampil");
		$tgltutup=$this->input->post("id_ttutup");
		$tamsiswa=$this->input->post("id_asiswa");
		$tampengajar=$this->input->post("id_apengajar");
		$datapengumuman=array(

			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup,
			'tampil_siswa' => $tamsiswa,
			'tampil_pengajar' => $tampengajar
		);
		$this->db->where('pengumuman_id', $id_peng);
		$this->db->update('pengumuman', $datapengumuman);
	}

	function deletepengumuman(){
		$id_list_pengumuman=$this->input->post("id_list_pengumuman");
		$this->db->where('pengumuman_id', $id_list_pengumuman);
		$this->db->delete('pengumuman');
	}

}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudpengumuman extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectpengumuman(){
		$query = $this->db->query("select * from pengumuman where tgl_tutup >= curdate()");
	 	$this->db->last_query();
	 return $query;
	}

	function insertpengumuman(){

		$judul				=$this->input->post("id_judul");
		$konten				=$this->input->post("id_konten");
		$tgltampil		=$this->input->post("id_ttampil");
		$tgltutup			=$this->input->post("id_ttutup");
		$datapengumuman=array(
			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup
		);
	//print_r($agama)
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
		$datapengumuman=array(

			'judul' => $judul,
			'konten' => $konten,
			'tgl_tampil' => $tgltampil,
			'tgl_tutup' => $tgltutup
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

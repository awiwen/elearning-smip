<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudsiswa extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectsiswa(){
		$query = $this->db->query("select * from siswa");
		return $query;
	}

	function insertsiswa(){

		$nis=$this->input->post("id_is");
		$nama=$this->input->post("id_nama");
		$jk=$this->input->post("id_jk");
		$tel=$this->input->post("id_tel");
		$tam=$this->input->post("id_tam");
		$agama=$this->input->post("id_agama");
		$alamat=$this->input->post("id_alamat");
		$tm=$this->input->post("id_tm");
		$status=$this->input->post("id_status");
		$datasiswa=array(
			'nis' => $nis,
			'nama' => $nama,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tel,
			'tgl_lahir' => $tam,
			'agama' => $agama,
			'alamat' => $alamat,
			'tahun_masuk' => $tm,
			'status_id' => $status
		);
		$this->db->insert('siswa', $datasiswa);
	}

	function selecteditsiswa(){
		$id_list_siswa=$this->input->post('id_list_siswa');
		$query= $this->db->query("select * from siswa where id='$id_list_siswa'");
		return $query;
	}

	function editsiswa(){
		$ids=$this->input->post("id_siswa");
		$nis=$this->input->post("id_is");
		$namaa=$this->input->post("id_nama");
		$jk=$this->input->post("id_jk");
		$tel=$this->input->post("id_tel");
		$tam=$this->input->post("id_tam");
		$agama=$this->input->post("id_agama");
		$alamat=$this->input->post("id_alamat");
		$tm=$this->input->post("id_tm");
		$status=$this->input->post("id_status");
		$datasiswa=array(
			'nis' => $nis,
			'nama' => $namaa,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tel,
			'tgl_lahir' => $tam,
			'agama' => $agama,
			'alamat' => $alamat,
			'tahun_masuk' => $tm,
			'status_id' => $status
		);
		$this->db->where('id', $ids);
		$this->db->update('siswa', $datasiswa);
	}

	function deletesiswa(){
		$id_list_siswa=$this->input->post("id_list_siswa");
		$this->db->where('id', $id_list_siswa);
		$this->db->delete('siswa');
	}

}
?>

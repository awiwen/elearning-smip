<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkelas_siswa extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function showkelas_siswa($kelas_id = null){
		$this->db->select("*");
		$this->db->join('siswa', 'siswa.siswa_id = kelas_siswa.siswa_id','right');
		$this->db->where("kelas_siswa.kelas_id",$kelas_id);
		$query = $this->db->get("kelas_siswa");
		$this->db->last_query();
		return $query;
	}

	function selectkelas_siswax(){
		$query = $this->db->query("select id, kelas_id, kelas_id FROM kelas_siswa WHERE kelas_id='4'");
		$this->db->join('kelas', 'kelas.nama_kelas = kelas_siswa.kelas_id','right');
		$query = $this->db->get('kelas_siswa');
		$this->db->last_query();

		return $query;
	}

	function selectkelas_siswa(){
		$query = $this->db->query("select * from kelas_siswa");
		return $query;
	}

	function joinsiswakelas(){
		$query = $this->db->query("select * from kelas_siswa");
		return $query;
	}

	function selectsiswa(){
			$query = $this->db->query("select * from siswa");
			return $query;
		}
	function selectkelas($kelas_id){
			$query = $this->db->query("select * from kelas where parent_id is not null");
			return $query;
		}

	function insertkelas_siswa(){
		$jumlah = $this->db->query("select * from kelas_siswa where siswa_id='".$this->input->post("id_siswa")."' and kelas_id='".$this->input->post("id_kelas")."' ")->num_rows();
		if($jumlah<1){

		$kelas=$this->input->post("id_kelas");
		$siswa=$this->input->post("id_siswa");
		$datakelas_siswa=array(

			'kelas_id' => $kelas,
			'siswa_id' => $siswa
		);
		$this->db->insert('kelas_siswa', $datakelas_siswa);
		}
		else {
			echo 'Siswa yang dipilih sudah memiliki kelas';
		}
	}

	function selecteditkelas_siswa(){
		$id_list_kelas_siswa=$this->input->post('id_list_kelas_siswa');
		$query= $this->db->query("select * from kelas_siswa where id='$id_list_kelas_siswa'");
		return $query;
	}

	function editkelas_siswa(){
		$jumlah = $this->db->query("select * from kelas_siswa where siswa_id='".$this->input->post("id_siswa")."' and kelas_id='".$this->input->post("id_kelas")."' ")->num_rows();
		if($jumlah<1){
		$idkelassiswa=$this->input->post("id_kelassiswa");
		$kelas=$this->input->post("id_kelas");
		$siswa=$this->input->post("id_siswa");
		$datakelas_siswa=array(
			'id' => $idkelassiswa,
			'kelas_id' => $kelas,
			'siswa_id' => $siswa,
		);
		$this->db->where('id', $idkelassiswa);
		$this->db->update('kelas_siswa', $datakelas_siswa);
		}
		else {
			echo 'Siswa yang dipilih sudah memiliki kelas';
		}
	}

	function deletekelas_siswa(){
		$id_list_kelas_siswa=$this->input->post("id_list_kelas_siswa");
		$this->db->where('id', $id_list_kelas_siswa);
		$this->db->delete('kelas_siswa');
	}

}
?>

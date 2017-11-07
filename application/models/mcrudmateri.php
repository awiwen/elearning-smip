<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmateri extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectParent(){
		$query = $this->db->query("select * from kelas where parent_id is null");
		return $query;
	}

	function selectkelas($kelas_id){
		$query = $this->db->query("select * from kelas where parent_id = '".$kelas_id."'");
		return $query;
	}

	function showmapel($kelas_id = null){
		$this->db->select("*");
		$this->db->join('mapel', 'mapel.mapel_id = mapel_kelas.mapel_id','right');
		$this->db->where("mapel_kelas.kelas_id",$kelas_id);
		$query = $this->db->get("mapel_kelas");
		$this->db->last_query();
		return $query;
	}

	function showmateri($mapel_id = null){
			$this->db->select("*");
			$this->db->where("mapel_id",$mapel_id);
			$query = $this->db->get("materi");
			return $query;
		}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}

	function selectpengajar(){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}

	function selectkelasadd(){
			$query = $this->db->query("select * from kelas");
			return $query;
		}

	function selectmaterix(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();

		return $query;
	}

	function selectmateri(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function insertmateri(){

		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten");
		$file=$this->input->post("id_file");
		$tposting=$this->input->post("id_tposting");
		$mapel=$this->input->post("id_mapel");
		$pengajar=$this->input->post("id_pengajar");
		$kelas=$this->input->post("id_kelas");
		$datamateri=array(
			'judul' => $judul,
			'konten' => $konten,
			'file' => $file,
			'tgl_posting' => $tposting,
			'mapel_id' => $mapel,
			'pengajar_id' => $pengajar,
			'kelas_id' => $kelas
		);
		$this->db->insert('materi', $datamateri);
		$this->db->insert('materi_kelas', $datamateri);
	}

	function selectdetailmateri(){
		$id_list_materi=$this->input->post('id_list_materi');
		$query= $this->db->query("select * from materi where materi_id='$id_list_materi'");
		return $query;
	}

	function selecteditmateri(){
		$id_list_mapel_kelas=$this->input->post('id_list_mapel_kelas');
		$query= $this->db->query("select * from mapel_kelas where id='$id_list_mapel_kelas'");
		return $query;
	}

	function editmateri(){
		$ids=$this->input->post("id_mapel_kelas");
		$namamapel_kelas=$this->input->post("id_namamapel_kelas");
		$parent=$this->input->post("id_parent");
		$status=$this->input->post("id_status");
		$datamapel_kelas=array(
			'id' => $ids,
			'nama_mapel_kelas' => $namamapel_kelas,
			'parent_id' => $parent,
			'status_id' => $status
		);
		$this->db->where('id', $ids);
		$this->db->update('mapel_kelas', $datamapel_kelas);
	}

	function deletemateri(){
		$id_list_mapel_kelas=$this->input->post("id_list_mapel_kelas");
		$this->db->where('id', $id_list_mapel_kelas);
		$this->db->delete('mapel_kelas');
	}

}
?>

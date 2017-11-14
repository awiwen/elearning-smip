<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudkomen_materi extends CI_Model {

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

	function showkomen_materi($mapel_id = null){
			$this->db->select("*");
			$this->db->where("mapel_id",$mapel_id);
			$query = $this->db->get("komen_materi");
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

		function selectkelasedit($kelas_id){
				$query = $this->db->query("select * from kelas where parent_id is not null");
				return $query;
			}

	function selectmaterix(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();

		return $query;
	}

	function selectkomen_materi(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function insertkomen_materi(){

		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten");
	//	$file=$this->input->post("id_file");
	//	$tposting=$this->input->post("id_tposting");
		$tposting = date("Y-m-d H:i:s");
		$mapel=$this->input->post("id_mapel");
		$pengajar=$this->input->post("id_pengajar");
		echo $kelas=$this->input->post("id_kelas");
		$datakomen_materi=array(
			'judul' => $judul,
			'konten' => $konten,
		//	'file' => $file,
			'tgl_posting' => $tposting,
			'mapel_id' => $mapel,
			'pengajar_id' => $pengajar
		//	'kelas_id' => $kelas
		);

		$this->db->insert('komen_materi', $datakomen_materi);

		$id_komen_materi = $this->db->insert_id();

		$datakomen_materi_kelas=array(
			'komen_materi_id' => $id_komen_materi,
			'kelas_id' => $kelas
		);
		$this->db->insert('komen_materi_kelas', $datakomen_materi_kelas);
	}

	// function insertkelas(){
	//
	// echo $kelas=$this->input->post("id_kelas");
	// 	$datakelas=array(
	// 		'komen_materi_id' => '2424',
	// 		'kelas_id' => $kelas
	// 	);
	// 	$this->db->insert('komen_materi_kelas', $datakelas);
	// }

	function selectdetailkomen_materi(){
		$id_list_komen_materi=$this->input->post('id_list_komen_materi');
		$query= $this->db->query("select * from komen_materi where komen_materi_id='$id_list_komen_materi'");
		return $query;
	}

	function selecteditkomen_materi(){
		$id_list_komen_materi=$this->input->post('id_list_komen_materi');
		$query= $this->db->query("select * from komen_materi where komen_materi_id='$id_list_komen_materi'");
		return $query;
	}

	function editkomen_materi(){
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

	function deletekomen_materi(){
		$id_list_komen_materi=$this->input->post("id_list_komen_materi");
		$this->db->where('komen_materi_id', $id_list_komen_materi);
		$this->db->delete('komen_materi');
	}

	function selectkomen_materiup(){
		$komen_materiup=$this->input->post('komen_materi_id');
		$query= $this->db->query("select * from komen_materi where komen_materi_id='$komen_materiup'");
		return $query;
	}

}
?>

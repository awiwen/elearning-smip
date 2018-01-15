<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcruddashboard_s extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

// 	function showmapel_ajar($hari_id = null,$kelas_id = null){
// //		$query = $this->db->query("select * from mapel_ajar");
// 		$this->db->join('mapel_kelas', 'mapel_kelas.id = mapel_ajar.mapel_kelas_id','left');
// 		$this->db->join('mapel', 'mapel.mapel_id = mapel_kelas.mapel_id','left');
// 		$this->db->join('pengajar', 'pengajar.pengajar_id = mapel_ajar.pengajar_id','left');
// 		$this->db->where('kelas_id',$kelas_id);
// 		$this->db->where("mapel_ajar.hari_id",$hari_id);
// 		$query = $this->db->get('mapel_ajar');
//  		$this->db->last_query();
// 		return $query;
// 	}

	function showmapel_ajar($hari_id = null,$kelas_id = null){

		$query = $this->db->query("select * FROM `mapel_ajar`
															LEFT JOIN `mapel_kelas` ON `mapel_kelas`.`id` = `mapel_ajar`.`mapel_kelas_id`
															LEFT JOIN `mapel` ON `mapel`.`mapel_id` = `mapel_kelas`.`mapel_id`
															LEFT JOIN `pengajar` ON `pengajar`.`pengajar_id` = `mapel_ajar`.`pengajar_id`
															WHERE `kelas_id` = '$kelas_id' AND `mapel_ajar`.`hari_id` = '$hari_id' ORDER BY `jam_mulai`
 														 	 ");
		$this->db->last_query();
		return $query;
	}

	function selectmapel_kelasx(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();
		return $query;
	}

	function selectpengajar(){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}

	function selecthari(){
			$query = $this->db->query("select * from hari");
			return $query;
		}

	function selectmapel_kelas(){
		$query = $this->db->query("select * from mapel_kelas left join kelas on mapel_kelas.kelas_id = kelas.kelas_id
															 left join mapel on mapel_kelas.mapel_id=mapel.mapel_id
 														 	 where parent_id is not null");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}
	function selectkelas($id){
			$this->db->select("*");
			$this->db->join('kelas','kelas.kelas_id = siswa.kelas_id','left');
			$this->db->where("siswa.siswa_id",$id);
			$this->db->group_by("kelas.kelas_id");
			$query = $this->db->get("siswa");
			$this->db->last_query();
			return $query;
		}

		function showhari($kelas_id = null){
			$this->db->select("*");
			$this->db->join('hari', 'hari.hari_id = mapel_ajar.hari_id','right');
			$this->db->join('mapel_kelas', 'mapel_kelas.id = mapel_ajar.mapel_kelas_id','left');
			$this->db->where("mapel_kelas.kelas_id",$kelas_id);
			$this->db->group_by("hari.hari_id");
			$query = $this->db->get("mapel_ajar");
			//echo $this->db->last_query();
			return $query;
		}

	function insertdashboard(){
		$hari=$this->input->post("id_hari");
		$mapel_kelas=$this->input->post("id_mapel_kelas");
		$pengajar=$this->input->post("id_pengajar");
		$jmulai=$this->input->post("id_jmulai");
		$jselesai=$this->input->post("id_jselesai");
		$datadashboard=array(
			'hari_id' => $hari,
			'mapel_kelas_id' => $mapel_kelas,
			'pengajar_id' => $pengajar,
			'jam_mulai' => $jmulai,
			'jam_selesai' => $jselesai
		);
		$this->db->insert('mapel_ajar', $datadashboard);
		$this->db->last_query();
	}

	function selecteditmapel_ajar(){
		$id_list_mapel_ajar=$this->input->post('id_list_mapel_ajar');
		$query= $this->db->query("select * from mapel_ajar where mapel_ajar_id='$id_list_mapel_ajar'");

		return $query;
	}

	function editdashboard(){
		$id_mapel_ajar=$this->input->post("id_mapel_ajar");
		$hari=$this->input->post("id_hari");
		$mapel_kelas=$this->input->post("id_mapel_kelas");
		$pengajar=$this->input->post("id_pengajar");
		$jmulai=$this->input->post("id_jmulai");
		$jselesai=$this->input->post("id_jselesai");
		$datamapel_ajar=array(
			'mapel_ajar_id' => $id_mapel_ajar,
			'hari_id' => $hari,
			'mapel_kelas_id' => $mapel_kelas,
			'pengajar_id' => $pengajar,
			'jam_mulai' => $jmulai,
			'jam_selesai' => $jselesai
		);
		$this->db->where('mapel_ajar_id', $id_mapel_ajar);
		$this->db->update('mapel_ajar', $datamapel_ajar);
		echo $this->db->last_query();
	}

	function deletedashboard(){
		$id_list_mapel_ajar=$this->input->post("id_list_mapel_ajar");
		$this->db->where('mapel_ajar_id', $id_list_mapel_ajar);
		$this->db->delete('mapel_ajar');
	}

}
?>

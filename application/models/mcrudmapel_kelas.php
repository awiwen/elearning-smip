<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudmapel_kelas extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectmapel_kelas(){
		$query = $this->db->query("SELECT mapel_kelas.id, mapel_kelas.kelas_id, mapel_kelas.mapel_id,
																kelas.id, kelas.nama_kelas, mapel.id, mapel.nama_mapel
																FROM mapel INNER JOIN (kelas INNER JOIN mapel_kelas ON
																kelas.id=mapel_kelas.mapel_id) ON mapel.id=mapel_kelas.kelas_id");
		return $query;
	}

	function insertmapel_kelas(){
		// tabel mapel_kelas
		$kelasid=$this->input->post("id_kelasid");
		$mapelid=$this->input->post("id_mapelid");
		//tabel kelas
		$klsid=$this->input->post("id_klsid");
		$namaklsid=$this->input->post("id_namakls");
		//tabel mapel
		$mplid=$this->input->post("id_mplid");
		$namamplid=$this->input->post("id_namamplid");

		$datappn=array(
			'kelas_id' => $kelasid,
			'mapel_id' => $mapelid,

			'id' 				=> $klsid,
			'nama_kelas' => $namaklsid,

			'id' 				=> $mplid,
			'nama_mapel' => $namamplid

		);
		$this->db->insert('mapel_kelas, kelas, mapel', $datamapel_kelas);
	}

}
?>

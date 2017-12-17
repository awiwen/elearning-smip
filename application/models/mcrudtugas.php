<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudtugas extends CI_Model {

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

	function selectkelas_s($id){
			$this->db->select("*");
			$this->db->join('kelas','kelas.kelas_id = kelas_siswa.kelas_id','left');
			$this->db->where("kelas_siswa.siswa_id",$id);
			$this->db->group_by("kelas.kelas_id");
			$query = $this->db->get("kelas_siswa");
			$this->db->last_query();
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

	function showtugas($mapel_id = null,$kelas_id = null ){
			$this->db->select("*");
			$this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->where("tugas.mapel_id",$mapel_id);
			$this->db->where("tugas_kelas.kelas_id",$kelas_id);
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugas_p($mapel_id = null,$kelas_id = null,$pengajar_id){
			$this->db->select("*");
			$this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->where("tugas.mapel_id",$mapel_id);
			$this->db->where("tugas_kelas.kelas_id",$kelas_id);
			$this->db->where("pengajar_id",$pengajar_id);
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showjawaban($tugas_id = null){
			$this->db->select("*");
			$this->db->join('tugas_jawaban', 'siswa.siswa_id = tugas_jawaban.siswa_id','on');
			$this->db->where("tugas_jawaban.tugas_id",$tugas_id);
			$query = $this->db->get("siswa");
			$this->db->last_query();
			return $query;
		}

	function showjawaban_s($tugas_id = null,$siswa_id){
			$this->db->select("*");
			$this->db->join('tugas_jawaban', 'siswa.siswa_id = tugas_jawaban.siswa_id','on');
			$this->db->where("tugas_jawaban.tugas_id",$tugas_id);
			$this->db->where("siswa_id",$siswa_id);
			$query = $this->db->get("siswa");
			echo $this->db->last_query();
			return $query;
		}



	// function showtugas($mapel_id = null){
	// 		$this->db->select("*");
	// 		$this->db->where("mapel_id",$mapel_id);
	// 		$query = $this->db->get("tugas");
	// 		return $query;
	// 	}

	function selectmapel(){
			$query = $this->db->query("select * from mapel");
			return $query;
		}

		function selectmapeledit($mapel_id){
				$query = $this->db->query("select * from mapel");
				return $query;
			}

	function selectpengajar(){
			$query = $this->db->query("select * from pengajar");
			return $query;
		}

	function selectsiswa(){
			$query = $this->db->query("select * from siswa");
			return $query;
		}

	function selectkelasadd(){
			$query = $this->db->query("select * from kelas where parent_id is not null");
			return $query;
		}

		function selectkelasedit($kelas_id){
				$query = $this->db->query("select * from kelas where parent_id is not null");
				return $query;
			}

	function selecttugasx(){
		$query = $this->db->query("select id, kelas_id, mapel_id FROM mapel_kelas WHERE kelas_id='4'");
		$this->db->join('mapel', 'mapel.nama_mapel = mapel_kelas.mapel_id','right');
		$query = $this->db->get('mapel_kelas');
		$this->db->last_query();

		return $query;
	}

	function selecttugas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function joinmapelkelas(){
		$query = $this->db->query("select * from mapel_kelas");
		return $query;
	}

	function selecttugasup(){
		$tugasup=$this->input->post('tugas_id');
		$query= $this->db->query("select * from tugas where tugas_id='$tugasup'");
		return $query;
	}

	function selectjawabanup(){
		$jawabanup=$this->input->post('tugas_jawaban_id');
		$query= $this->db->query("select * from tugas_jawaban where tugas_jawaban_id='$jawabanup'");
		return $query;
	}

	function selecttugasjawaban(){
		$tugasjawab=$this->input->post('tugas_jawaban_id');
		$query= $this->db->query("select * from tugas_jawaban where tugas_jawaban_id='$tugasjawab'");
		return $query;
	}

	// function showjawaban(){
	// 	$query = $this->db->query("select * from tugas_jawaban");
	// 	// $this->db->select("*");
	// 	// $this->db->join('tugas_jawaban', 'tugas_jawaban.siswa_id = siswa.siswa_id','right');
	// 	// $query = $this->db->get("tugas_jawaban");
  //
	// 	echo $this->db->last_query();
	// 	return $query;
	// 	}

	function inserttugas(){
		$jumlah = $this->db->query("select * from mapel_kelas where mapel_id='".$this->input->post("id_mapel")."' and kelas_id='".$this->input->post("id_kelas")."' ")->num_rows();
		if($jumlah>0){
			$judul=$this->input->post("id_judul");
			$konten=$this->input->post("id_konten");
			$tbuat=$this->input->post("id_tbuat");
			$tgl_selesai=$this->input->post("id_tselesai");
			$mapel=$this->input->post("id_mapel");
			$pengajar=$this->input->post("id_pengajar");
			$kelas=$this->input->post("id_kelas");
			$datatugas=array(
				'judul' => $judul,
				'konten' => $konten,
				'tgl_buat' => $tbuat,
				'tgl_selesai' => $tgl_selesai,
				'mapel_id' => $mapel,
				'pengajar_id' => $pengajar

			);
			$this->db->insert('tugas',$datatugas);
			$tugas_id = $this->db->insert_id();

			$datatugaskelas=array(
				'tugas_id' => $tugas_id,
				'kelas_id' => $kelas
			);
			$this->db->insert('tugas_kelas', $datatugaskelas);
			echo 'Data Berhasil di Simpan' ;
		}
		else {
			echo 'Matapelajaran Tidak Ad di Kelas yang dipilih';
		}
	}

	function selectdetailtugas(){
		$id_list_tugas=$this->input->post('id_list_tugas');
		$query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
		return $query;
	}

	function selectedittugas(){
		$id_list_tugas=$this->input->post('id_list_tugas');
		$query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
		return $query;
	}

	// function edittugas(){
	// 	$ids=$this->input->post("id_mapel_kelas");
	// 	$namamapel_kelas=$this->input->post("id_namamapel_kelas");
	// 	$parent=$this->input->post("id_parent");
	// 	$datamapel_kelas=array(
	// 		'id' => $ids,
	// 		'nama_mapel_kelas' => $namamapel_kelas,
	// 		'parent_id' => $parent
	// 	);
	// 	$this->db->where('id', $ids);
	// 	$this->db->update('mapel_kelas', $datamapel_kelas);
	// }

	function edittugas(){
		$tugas_id=$this->input->post("id_tugas_id");
		$judul=$this->input->post("id_judul");
		$konten=$this->input->post("id_konten2");
		$tbuat=$this->input->post("id_tbuat");
		$tgl_selesai=$this->input->post("id_tselesai");
		$mapel=$this->input->post("id_mapel");
		$pengajar=$this->input->post("id_pengajar");
		$kelas=$this->input->post("id_kelas");
		$datatugas=array(
			'tugas_id'=> $tugas_id,
			'judul' => $judul,
			'konten' => $konten,
			'tgl_buat' => $tbuat,
			'tgl_selesai' => $tgl_selesai,
			'mapel_id' => $mapel,
			'pengajar_id' => $pengajar
		);

		$this->db->where('tugas_id', $tugas_id);
		$this->db->update('tugas', $datatugas);

		$this->db->last_query();

		$datatugaskelas=array(
			'tugas_id' => $tugas_id,
			'kelas_id' => $kelas
		);
		$this->db->where('tugas_id', $tugas_id);
		$this->db->update('tugas_kelas', $datatugaskelas);

		$this->db->last_query();
	}

	// function deletetugas(){
	// 	$id_list_tugas=$this->input->post("id_list_tugas");
	// 	$this->db->where('tugas_id', $id_list_tugas);
	// 	$this->db->delete('tugas');
	// 	echo $this->db->last_query();
	// }

	function insertjawaban(){
			$tugas_id=$this->input->post("id_tugas_id");
			$tbuat=$this->input->post("id_tbuatj");
			$siswa=$this->input->post("id_siswa");
			$datajawaban=array(
				'tugas_id' => $tugas_id,
				'tgl_buat' => $tbuat,
				'siswa_id' => $siswa

			);
			$this->db->insert('tugas_jawaban',$datajawaban);
			$tugas_jawaban_id = $this->db->insert_id();
			$this->db->last_query();
		}


	function deletetugas(){
		$id_list_tugas=$this->input->post("id_list_tugas");
		$this->db->where('tugas_id', $id_list_tugas);
		$this->db->delete('tugas');
		$this->db->last_query();
	}



}

?>

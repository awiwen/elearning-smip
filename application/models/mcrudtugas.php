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
			$this->db->join('kelas','kelas.kelas_id = siswa.kelas_id','left');
			$this->db->where("siswa.siswa_id",$id);
			$this->db->group_by("siswa.kelas_id");
			$query = $this->db->get("siswa");
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
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->where("tugas.mapel_id",$mapel_id);
			$this->db->where("tugas.kelas_id",$kelas_id);
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugascari(){
			$this->db->select("*");
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->join('pengajar', 'tugas.pengajar_id = pengajar.pengajar_id','left');
			$this->db->join('mapel', 'tugas.mapel_id = mapel.mapel_id','left');
			$this->db->join('kelas', 'tugas.kelas_id = kelas.kelas_id','left');
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugascari_s($siswa){
			$this->db->select("*");
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->join('pengajar', 'tugas.pengajar_id = pengajar.pengajar_id','left');
			$this->db->join('mapel', 'tugas.mapel_id = mapel.mapel_id','left');
			$this->db->join('kelas', 'tugas.kelas_id = kelas.kelas_id','left');
			$this->db->join('siswa', 'kelas.kelas_id = siswa.kelas_id','left');
			$this->db->where("siswa.siswa_id" ,$siswa);
			$this->db->Select (' pengajar.nama as nama_pengajar , siswa.nama as nama_siswa');
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugascari_p($pengajar){
			$this->db->select("*");
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->join('pengajar', 'tugas.pengajar_id = pengajar.pengajar_id','left');
			$this->db->join('mapel', 'tugas.mapel_id = mapel.mapel_id','left');
			$this->db->join('kelas', 'tugas.kelas_id = kelas.kelas_id','left');
			// $this->db->join('siswa', 'kelas.kelas_id = siswa.kelas_id','left');
			$this->db->where("pengajar.pengajar_id" ,$pengajar);
			// $this->db->Select (' pengajar.nama as nama_pengajar , siswa.nama as nama_siswa');
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugasadmin($mapel_id = null){
			$this->db->select("*");
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->where("tugas.mapel_id",$mapel_id);
//			$this->db->where("tugas_kelas.kelas_id",$kelas_id);
			$query = $this->db->get("tugas");
			$this->db->last_query();
			return $query;
		}

	function showtugas_p($mapel_id = null,$kelas_id = null,$pengajar_id){
			$this->db->select("*");
			// $this->db->join('tugas_kelas', 'tugas.tugas_id = tugas_kelas.tugas_id','left');
			$this->db->where("tugas.mapel_id",$mapel_id);
			$this->db->where("tugas.kelas_id",$kelas_id);
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
			$this->db->where("siswa.siswa_id",$siswa_id);
			$query = $this->db->get("siswa");
			$this->db->last_query();
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
				'pengajar_id' => $pengajar,
				'kelas_id' => $kelas

			);
			$this->db->insert('tugas',$datatugas);
			$tugas_id = $this->db->insert_id();
			// echo $this->db->last_query();

			// $datatugaskelas=array(
			// 	'tugas_id' => $tugas_id,
			// 	'kelas_id' => $kelas
			// );
			// $this->db->insert('tugas_kelas', $datatugaskelas);
			// $id_tugas_kelas = $this->db->insert_id();

	    $this->load->model('mnotifikasi');
	    $query = $this->mnotifikasi->selectsiswa($kelas);

			// print_r($query->result());
	    foreach($query->result() as $row){
				 $row->login_id."</br>";
		    $pesan= 'Tugas';
		    $tgl= $tgl_selesai;
		    $oleh= $judul;
		    $login_id= $row->login_id ;
		    $status_id= 1;
				$link = 'http://localhost/elearning-smip/index.php/cdetailtugas/showdetailtugas/'.$tugas_id;
		    $datanotifikasi=array(
		      'pesan' => $pesan,
		      'tgl' => $tgl,
		      'oleh' => $oleh,
		      'login_id' => $login_id,
		      'status_id' => $status_id,
		      'tugas_id' => $tugas_id,
					'link' => $link,
		    );

				$this->mnotifikasi->insertnotifikasi($datanotifikasi);
			}
			echo 'Data Berhasil di Simpan' ;
		}
		else {
			echo 'Matapelajaran Tidak Ad di Kelas yang dipilih';
		}
	}

	function selectdetailtugas(){
		$id_list_tugas=$this->input->post('id_list_tugas');
		// $this->db->select("*");
		// $this->db->join('tugas', 'mapel.mapel_id = tugas.mapel_id','right');
		// $this->db->join('tugas_kelas', 'kelas.kelas_id = tugas_kelas.kelas_id','right');
		// $this->db->join('tugas', 'pengajar.pengajar_id = tugas.pengajar_id','right');
		// $this->db->join('tugas', 'tugas_kelas.tugas_id = tugas_kelas.tugas_id','right');
		// $this->db->where("tugas.tugas_id",$id_list_tugas);
		// echo $this->db->last_query();
		$query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
		return $query;
	}

	function selectdetailjawab($id_list_jawaban){
		// $id_list_jawaban=$this->input->post('id_list_jawaban');
		$query= $this->db->query("select * from tugas_jawaban where tugas_jawaban_id='$id_list_jawaban'");
		// echo $this->db->last_query();
		return $query;
	}

	// function selectdetailtugas(){
	// 	$id_list_tugas=$this->input->post('id_list_tugas');
	// 	$query= $this->db->query("select * from tugas where tugas_id='$id_list_tugas'");
	// 	return $query;
	// }

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
			'pengajar_id' => $pengajar,
			'kelas_id' => $kelas,
		);

		$this->db->where('tugas_id', $tugas_id);
		$this->db->update('tugas', $datatugas);

		$this->db->last_query();

		// $datatugaskelas=array(
		// 	'tugas_id' => $tugas_id,
		// 	'kelas_id' => $kelas
		// );
		// $this->db->where('tugas_id', $tugas_id);
		// $this->db->update('tugas_kelas', $datatugaskelas);
    //
		// $this->db->last_query();
	}

	// function deletetugas(){
	// 	$id_list_tugas=$this->input->post("id_list_tugas");
	// 	$this->db->where('tugas_id', $id_list_tugas);
	// 	$this->db->delete('tugas');
	// 	echo $this->db->last_query();
	// }

	// function insertjawaban(){
	// 		$tugas_id=$this->input->post("id_tugas_id");
	// 		$tbuat=$this->input->post("id_tbuatj");
	// 		$siswa=$this->input->post("id_siswa");
	// 		$datajawaban=array(
	// 			'tugas_id' => $tugas_id,
	// 			'tgl_buat' => $tbuat,
	// 			'siswa_id' => $siswa
  //
	// 		);
	// 		$this->db->insert('tugas_jawaban',$datajawaban);
	// 		$tugas_jawaban_id = $this->db->insert_id();
	// 		$this->db->last_query();
  //
	// 		$this->load->model('mnotifikasi');
	//     $query = $this->mnotifikasi->selectpengajar(46);
  //
	//     foreach($query->result() as $row){
	// 			$row->login_id."</br>";
	// 	    $pesan= 'Jawaban';
	// 	    $tgl= $tbuat;
	// 	    $oleh= $siswa;
	// 	    $login_id= $row->login_id ;
	// 	    $status_id= 1;
	// 			$link = 'http://localhost/elearning-smip/index.php/ctrlpages/tugas_p';
	// 	    $datanotifikasi=array(
	// 	      'pesan' => $pesan,
	// 	      'tgl' => $tgl,
	// 	      'oleh' => $oleh,
	// 	      'login_id' => $login_id,
	// 	      'status_id' => $status_id,
	// 				'link' => $link,
	// 	    );
  //
	// 			$this->mnotifikasi->insertnotifikasi($datanotifikasi);
	// 		}
	// 	}

	function insertjawaban(){
				$tugas_id=$this->input->post("id_tugas_id");
				$tbuat=$this->input->post("id_tbuatj");
				$siswa=$this->input->post("id_siswa");
				$konten=$this->input->post("id_konten");
				$datajawaban=array(
					'tugas_id' => $tugas_id,
					'tgl_buat' => $tbuat,
					'konten' => $konten,
					'siswa_id' => $siswa

				);
				$this->db->insert('tugas_jawaban',$datajawaban);
				$tugas_jawaban_id = $this->db->insert_id();
				// echo $this->db->last_query();

				$this->load->model('mnotifikasi');
		    $query = $this->mnotifikasi->selectpengajar($tugas_id);

				// print_r($query->result());
		    foreach($query->result() as $row){
					$row->login_id."</br>";
			    $pesan= 'Jawaban';
			    $tgl= $tbuat;
			    $oleh= $siswa;
			    $login_id= $row->login_id ;
			    $status_id= 1;
					$link = 'http://localhost/elearning-smip/index.php/cdetailjawab_s/showdetailjawab/'.$tugas_jawaban_id;
			    $datanotifikasi=array(
			      'pesan' => $pesan,
			      'tgl' => $tgl,
			      'oleh' => $oleh,
			      'login_id' => $login_id,
			      'status_id' => $status_id,
			      'tugas_jawaban_id' => $tugas_jawaban_id,
						'link' => $link,
			    );

					$this->mnotifikasi->insertnotifikasi($datanotifikasi);
					// echo $this->db->last_query();
				}
			}

	function deletetugas(){
		$id_list_tugas=$this->input->post("id_list_tugas");
		$this->db->where('tugas_id', $id_list_tugas);
		$this->db->delete('tugas');
		$this->db->last_query();
	}



}

?>

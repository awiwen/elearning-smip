<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudsiswa extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectsiswa_p(){
		$query = $this->db->query("select `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `status_nama`,`alamat`,`tahun_masuk`,`agama`,`nama_kelas`,
																DATE_FORMAT(tgl_lahir, '%d %M %Y') AS `tanggal` FROM `siswa`
																LEFT JOIN `login` ON `siswa`.`siswa_id` = `login`.`siswa_id`
																LEFT JOIN `status` ON `siswa`.`status_id` = `status`.`status_id`
																LEFT JOIN `kelas` ON `siswa`.`kelas_id` = `kelas`.`kelas_id`");
		$this->db->last_query();
		return $query;
	}

	function selectsiswa(){
		$query = $this->db->query("select * from siswa");
		$this->db->select('*');
		$this->db->join('status', 'status.status_id = siswa.status_id','LEFT');
		$this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id','LEFT');
		$query = $this->db->get('siswa');
		$this->db->last_query();
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
		$kelas_id=$this->input->post("id_kelas");
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
			'kelas_id' => $kelas_id,
			'status_id' => $status
		);
	//print_r($agama);
	$this->db->insert('siswa', $datasiswa);
	}

	// function selecteditsiswa(){
	// 	$id_list_siswa=$this->input->post('id_list_siswa');
	// 	$query= $this->db->query("select * from siswa where siswa_id='$id_list_siswa'");
	// 	return $query;
	// }

	function selectstatus($status_id){
			$query = $this->db->query("select * from status");
			return $query;
		}

	function selecteditsiswa(){
		$id_list_siswa=$this->input->post('id_list_siswa');
		$query = $this->db->query("select * from siswa");
		$this->db->select('*');
		// $this->db->join('status', 'status.status_id = siswa.status_id','left');
		$this->db->where('siswa_id',$id_list_siswa);
		$query = $this->db->get('siswa');
		//	$this->db->where("'pengajar_id='$status_id'");
		$this->db->last_query();
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
		$kelas_id=$this->input->post("id_kelas");
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
			'kelas_id' => $kelas_id,
			'status_id' => $status
		);
		$this->db->where('siswa_id', $ids);
		$this->db->update('siswa', $datasiswa);
	}

	function deletesiswa(){
		echo $id_list_siswa=$this->input->post("id_list_siswa");
		$this->db->where('siswa_id', $id_list_siswa);
		$this->db->delete('siswa');
		$this->db->last_query();
	}

}
?>

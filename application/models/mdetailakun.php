<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailakun extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function selectdetailakun_s($id){
      $this->db->select("*");
      $this->db->join('login', 'siswa.siswa_id = login.siswa_id','left');
      $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id','left');
      $this->db->join('status', 'siswa.status_id = status.status_id','left');
      $this->db->where("login.login_id" ,$id);
      // $this->db->Select (' pengajar.nama as nama_pengajar , siswa.nama as nama_siswa');
      $query = $this->db->get("siswa");
      $this->db->last_query();
      return $query;
    }

		// function selectdetailakun_p($id){
	  //     $this->db->select("*");
	  //     $this->db->join('login', 'pengajar.pengajar_id = login.pengajar_id','left');
	  //     $this->db->join('status', 'pengajar.status_id = status.status_id','left');
	  //     $this->db->where("login.login_id" ,$id);
	  //     $query = $this->db->get("pengajar");
	  //     echo $this->db->last_query();
	  //     return $query;
	  //   }

			function selectdetailakun_p($id){
		      $query = $this->db->query("select `nuptk`, `nama`, `jenis_kelamin`, `tempat_lahir`, `pend_terakhir`, `b_studi`, `status_nama`,`alamat`,
																			DATE_FORMAT(tgl_lahir, '%d %M %Y') AS `tanggal`,
																			(YEAR(CURDATE())-YEAR(tahun_masuk)) AS `masa_kerja` FROM `pengajar`
																			LEFT JOIN `login` ON `pengajar`.`pengajar_id` = `login`.`pengajar_id`
																			LEFT JOIN `status` ON `pengajar`.`status_id` = `status`.`status_id`
																			WHERE `login`.`login_id` = '$id'");
		      // echo $this->db->last_query();
		      return $query;
		    }

}
?>

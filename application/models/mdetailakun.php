<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdetailakun extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function selectdetailakun_s(){
      $query=$this->db->query("select * FROM `siswa`
																LEFT JOIN `kelas` ON `siswa`.`kelas_id` = `kelas`.`kelas_id`
																LEFT JOIN `status` ON `siswa`.`status_id` = `status`.`status_id`
																WHERE `siswa`.`siswa_id`=232");
      echo $this->db->last_query();
      return $query;
    }

	function selectdetailakun_p(){
			$query=$this->db->query("select * FROM `pengajar`
																LEFT JOIN `status` ON `pengajar`.`status_id` = `status`.`status_id`
																WHERE `pengajar`.`pengajar_id`=17");
			echo $this->db->last_query();
			return $query;
		}

    // function selectdetailakun_s($siswa){
    //     $this->db->select("*");
    //     $this->db->join('login', 'siswa.siswa_id = login.siswa_id','left');
    //     $this->db->join('siswa', 'kelas.kelas_id = siswa.kelas_id','left');
    //     $this->db->where("siswa.siswa_id" ,$siswa);
    //     // $this->db->Select (' pengajar.nama as nama_pengajar , siswa.nama as nama_siswa');
    //     $query = $this->db->get("siswa");
    //     echo $this->db->last_query();
    //     return $query;
    //   }
}
?>

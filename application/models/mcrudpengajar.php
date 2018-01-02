<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrudpengajar extends CI_Model {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function selectpengajar(){
		$query = $this->db->query("select * from pengajar");
		$this->db->select('*');
		$this->db->join('status', 'status.status_id = pengajar.status_id','left');
		$query = $this->db->get('pengajar');
		$this->db->last_query();
		return $query;
	}

	function selectstatus(){
		$query = $this->db->query("select * from status");
	}

	function selectdetailpengajar($pengajar_id){
    $query = $this->db->query("select `pengajar_id`, `nuptk`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`,
																`alamat`,`status_kg`,`pend_terakhir`,`b_studi`,`tahun_masuk`,
																(YEAR(CURDATE())-YEAR(tahun_masuk)) AS `masa_kerja` FROM `pengajar`
																RIGHT JOIN `status` ON `pengajar`.`status_id` = `status`.`status_id`
																WHERE `pengajar`.`pengajar_id` = '$pengajar_id'");
    echo $this->db->last_query();
     return $query;
  }

	// function selectdetailpengajar($pengajar_id){
  //   $this->db->select("*");
  //   $this->db->join('status', 'pengajar.status_id = status.status_id','right');
  //   $this->db->where("pengajar.pengajar_id",$pengajar_id);
  //   $query = $this->db->get('pengajar');
  //   echo $this->db->last_query();
  //    return $query;
  // }

	function insertpengajar(){
		$nip=$this->input->post("id_nip");
		$nama=$this->input->post("id_nama");
		$jk=$this->input->post("id_jk");
		$tel=$this->input->post("id_tel");
		$tam=$this->input->post("id_tam");
		$alamat=$this->input->post("id_alamat");
		$status=$this->input->post("id_status");
		$datapengajar=array(
			'nip' => $nip,
			'nama' => $nama,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tel,
			'tgl_lahir' => $tam,
			'alamat' => $alamat,
			'status_id' => $status
		);
		$this->db->insert('pengajar', $datapengajar);
	}

	function selecteditpengajar(){
		$id_list_pengajar=$this->input->post('id_list_pengajar');
		$query = $this->db->query("select * from pengajar");
		$this->db->select('*');
		$this->db->join('status', 'status.status_id = pengajar.status_id','left');
		$this->db->where('pengajar_id',$id_list_pengajar);
		$query = $this->db->get('pengajar');
	//	$this->db->where("'pengajar_id='$status_id'");
		$this->db->last_query();
		return $query;
	}

	function editpengajar(){
		$ids=$this->input->post("id_pengajar");
		$nip=$this->input->post("id_nip");
		$namaa=$this->input->post("id_nama");
		$jk=$this->input->post("id_jk");
		$tel=$this->input->post("id_tel");
		$tam=$this->input->post("id_tam");
		$alamat=$this->input->post("id_alamat");
		$status=$this->input->post("id_status");
		$datapengajar=array(
			'pengajar_id' => $ids,
			'nip' => $nip,
			'nama' => $namaa,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tel,
			'tgl_lahir' => $tam,
			'alamat' => $alamat,
			'status_id' => $status
		);
		$this->db->where('pengajar_id', $ids);
		$this->db->update('pengajar', $datapengajar);
	}

	function deletepengajar(){
		$id_list_pengajar=$this->input->post("id_list_pengajar");
		$this->db->where('pengajar_id', $id_list_pengajar);
		$this->db->delete('pengajar');
	}

}
?>

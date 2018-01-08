<?php
class Mnotifikasi extends CI_Model {

    var $tabel = 'notifikasi';

    function __construct() {
    parent::__construct();
    }

    function notif_count($id, $status) {
        $this->db->from($this->tabel);
        $this->db->where('login_id',$id);
        $this->db->where('status_id',$status);
        $query = $this->db->get();
        return $query->num_rows();
    }

  function getnotifikasi($id, $status) {
      $this->db->from($this->tabel);
      $this->db->where('login_id',$id);
      $this->db->where('status_id',$status);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get();
      return $query->result();
  }

   function selectsiswa($kelas_id){
     $this->db->select("*");
     $this->db->join('siswa','siswa.siswa_id = login.siswa_id','left');
     $this->db->where("siswa.kelas_id",$kelas_id);
     $query = $this->db->get("login");
     $this->db->last_query();
     return $query;
   }

   function selectpengajar($tugas_id){
     $this->db->select("*");
     $this->db->join('pengajar','tugas.pengajar_id = pengajar.pengajar_id','left');
     $this->db->join('login','pengajar.pengajar_id = login.pengajar_id','left');
     // $this->db->join('tugas','pengajar.pengajar_id = tugas.pengajar_id','left');
     $this->db->where("tugas.tugas_id",$tugas_id);
     $query = $this->db->get("tugas");
     echo $this->db->last_query();
     return $query;
   }

   function selectpengumuman(){
    $this->db->select("*");
    $this->db->join('siswa','siswa.siswa_id = login.siswa_id','left');
  //   $this->db->where("siswa.kelas_id",$kelas_id);
    $query = $this->db->get("login");
    $this->db->last_query();
     return $query;
   }

  function insertnotifikasi($data){

    $this->db->insert('notifikasi', $data);
    $this->db->last_query();
  }

    function ginsert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

}
?>

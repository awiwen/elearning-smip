<?php

class Tampilkan_siswa extends CI_Model{

            function tampilkan_data(){
                        
                        return $this->db->get('el_siswa');

            }

}

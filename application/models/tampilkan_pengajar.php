<?php

class Tampilkan_pengajar extends CI_Model{

            function tampilkan_data(){

                        return $this->db->get('el_pengajar');

            }

}

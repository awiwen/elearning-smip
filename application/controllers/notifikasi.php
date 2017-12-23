<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    /*****
     | Notifikasi Facebook Codeigniter dan Bootstrap
     | controller notifikasi
     | by g2tech
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('mnotifikasi');   //load model mnotifikasi
        $this->load->helper('form','url');  //load helper ci form dan url
    }

    public function index()
    {
        $data['title'] = 'Notifikasi seperti difacebook CodeIgniter'; //judul title
        $data['jlhnotif'] =$this->mnotifikasi->notif_count();  //menghitung jumlah post
        $data['notifikasi'] =$this->mnotifikasi->getnotifikasi(); //menampilkan isi postingan

        $this->load->view('vnotifikasi',$data); //load view vnotifikasi

    }

    public function postkan(){
        //ambil variabel yang dikirim jquery post
        $pesan  = addslashes($this->input->post('pesan'));
        $nama   = addslashes($this->input->post('nama'));

        $data = array(
            'oleh'     => $nama,
            'pesan'     => $pesan,
            'tgl'  => time()
        );
        $this->mnotifikasi->ginsert($data);    //menyimpan data ke database melalu model mnotifikasi pada fungsi ginsert

    }

    public function load_row(){     //fungsi load_row untuk menampilkan jlh data pada navbar secara realtime
        echo $this->mnotifikasi->notif_count(); //jumlah data akan langsung di tampilkan
    }

    public function load_data(){    //fungsi load_data untuk menampilkan isi data pada navbar secara realtime
        $data=$this->mnotifikasi->getnotifikasi();
        $no=0;foreach($data as $rdata){ $no++;
            if($no % 2==0){$strip='strip1';}
                    else{$strip='strip2';}
            echo"<li><a href=\"#\" class=\"".$strip."\">".$rdata->pesan."<br>
            <small>".$rdata->oleh." ".timeAgo($rdata->tgl)."</small>
            </a><li>";
        }
    }
}

/* End of file notifikasi.php */
/* Location: ./application/controllers/notifikasi.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        $this->load->model('Admin_model');       

    }

    public function index()
    {   
        $data['title'] = "Dashboard";
        $this->load->view('header0');
        // $this->load->view('admin/index', $data, FALSE);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }

    public function indexproduksi()
    {
        $data['title'] = "Dashboard";
        $this->load->view('header1');
        $this->load->view('barproduksi');
        $this->load->view('staffproduksi/index', $data, FALSE);
        $this->load->view('footer');
    }


    public function indexgudang()
    {
        $data['title'] = "Dashboard";
        $this->load->view('header1');
        $this->load->view('bargudang');
        $this->load->view('staffgudang/index', $data, FALSE);
        $this->load->view('footer');
    }


    public function indexpengiriman()
    {
        $data['title'] = "Dashboard";
        $this->load->view('header1');
        $this->load->view('barpengiriman');
        $this->load->view('staffpengiriman/index', $data, FALSE);
        $this->load->view('footer');
    }



        // confirm all notification
        function confirmAllNotification() {
            $page = $this->input->get('page');
            $this->db->update('notifikasi', ['read_status' => "seen"]);

            redirect($page);
        }

}
?>
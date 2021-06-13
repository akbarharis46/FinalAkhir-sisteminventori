<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StaffPengirimanClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
     

    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/index', $data, FALSE);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }
}
?>
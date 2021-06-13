<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StaffGudangClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        $this->load->model('admin_model');       

    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('header1');
        $this->load->view('bargudang');
        $this->load->view('staffgudang/index', $data, FALSE);
        $this->load->view('footer');
    }

}
?>
<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('curl');
    $this->load->library('session');
    $this->load->model('Login_model');
  }

  public function index()
  {
    $data['title'] = 'login';
    $this->load->view('login/index', $data);
  }


  public function log_process()
  {
    $user = $this->input->post('user');
    $password = $this->input->post('password');
    $check = $this->Login_model->login($user, $password);
    if ($check) {
      foreach ($check as $rows) {
        $this->session->set_userdata('id', $rows->id);
        $this->session->set_userdata('username', $rows->username);
        $this->session->set_userdata('level', $rows->level);

        // redirect('userclient');
      }
      // print_r($check);
      // exit;
      if ($this->session->userdata('level') == "admin") {
        redirect('AdminClient');
      } elseif ($this->session->userdata('level') == "Staff Produksi") {
        redirect('StaffProduksiClient');
      } elseif ($this->session->userdata('level') == "Staff Gudang") {
        redirect('StaffGudangClient');
      } elseif ($this->session->userdata('level') == "Staff Pengiriman") {
        redirect('StaffPengirimanClient');
      } else {
        return false;
      }
    } else {
      $this->session->set_flashdata('result', 'Login gagal');
      redirect('login');
    }
  }

  public function reg()
  {
    $data['title'] = 'registrasi';
    $this->load->view('header1', $data, FALSE);
    $this->load->view('login/registrasi', $data, FALSE);
    $this->load->view('footer', $data, FALSE);
  }


  public function out()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }



  // show forgot password
  function forgot() {

    $this->load->view('login/forgot');
  }



  // verify
  function verify() {

    $pencarianUsername = array(
      'username'  => $this->input->post('username'), 
    );

    $postKodeUnik = $this->input->post('kode_unik');

    $data = $this->db->get_where('login', $pencarianUsername);
    if ( $data->num_rows() > 0 ) {
      $kolom = $data->row_array();

      if ( $kolom['kode_unik'] ==  $postKodeUnik) {


        $this->setting( $kolom['id'] );

      } else {

        $this->session->set_flashdata('msg', 'kode yang anda masukkan tidak valid !');  
        redirect('login/forgot');

      }

    } else {

      $this->session->set_flashdata('msg', 'Akun tidak terdaftar !');
      redirect('login/forgot');
    }
  }



  // new password
  function setting( $id_login ) {

      $data['id'] = $id_login;
      $this->load->view('login/new-password', $data);
  }


  function processUpdateAccount( $id_login ) {

    $this->load->library('form_validation');

    $this->form_validation->set_rules('new_pw', 'Password', 'required');
    $this->form_validation->set_rules('confirm_pw', 'Confirm Password', 'required|matches[new_pw]');


    if ( $this->form_validation->run() ) {

      
      $updatePassword = array(

        'password'  => $this->input->post('new_pw')
      );
      $this->db->where('id', $id_login)->update('login', $updatePassword);

      redirect('login');

    } else {

      $this->session->set_flashdata('msg', 'Konfirmasi kata sandi tidak sama');
      redirect('login/setting/'. $id_login);
    }



  }

}


/* End of file Home.php */
?>
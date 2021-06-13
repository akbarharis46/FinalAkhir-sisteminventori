<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StaffProduksiClient extends CI_Controller
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
        $this->load->view('barproduksi');
        $this->load->view('staffproduksi/index', $data, FALSE);
        $this->load->view('footer');
    }
    
    // public function index1()
    // {
    //     $data['barang'] = json_decode($this->curl->simple_get($this->API));
    //     $data['title'] = "barang";
    //     $this->load->view('header1');
    //     $this->load->view('bar1');
    //     $this->load->view('staffproduksi/barang', $data);
    //     $this->load->view('footer');
    // }
    
    public function post()
    {
     $this->API2 = base_url('kategori');
     //$this->API2 = "http://localhost:8080/dummyTA/kategori";
     $data['kategori'] = json_decode($this->curl->simple_get($this->API2));

      $data['title'] = "Tambah Data barang";
      $this->load->view('header1');
      $this->load->view('bar1');
      $this->load->view('data/post/barang', $data);
      $this->load->view('footer');
    }
  
    public function post_process()
    {
        $data = array(
            'nama_barang'            => $this->input->post('nama_barang'),
            'nama_kategori'           => $this->input->post('nama_kategori'),
            'total'                  => $this->input->post('total'),
            'tanggal'                  => $this->input->post('tanggal'),
     
        );
        $insert =  $this->curl->simple_post($this->API,$data);
        if ($insert) {
            // echo"berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
        } else {
            // echo"gagal berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
        }
        // print_r($insert);
        // die;
        redirect('barangclient');
      }
    
    public function put()
    {
        $params = array('id_barang' =>  $this->uri->segment(3));
        $data['barang'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Barang";
        $this->load->view('header1');
        $this->load->view('bar1');
        $this->load->view('data/put/barang', $data);
        $this->load->view('footer');

    }
    public function put_process()
    {
        $data = array(
            
            'id_barang'            => $this->input->post('id_barang'),
            'nama_barang'            => $this->input->post('nama_barang'),
            'nama_kategori'           => $this->input->post('nama_kategori'),
            'total'                  => $this->input->post('total'),
            'tanggal'                  => $this->input->post('tanggal'),
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));
        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data kategori Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data kategori Gagal');
        }
        // print_r($update);
        // die;
        redirect('barangclient');
    }
    public function delete()
    {
        $params = array('id_barang' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('barangclient');
    }
    
}
?>
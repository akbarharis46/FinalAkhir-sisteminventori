<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KategoriClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        

        $this->API = base_url('kategori');

        // $this->API = "http://localhost:8080/dummyTA/kategori";
    }

    public function index()
    {
        $data['kategori'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "Kategori";
        $this->load->view('header0');
        $this->load->view('data/kategori', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }

    public function indexproduksi()
    {
        $data['kategori'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "kategori";
        $this->load->view('header1');
        $this->load->view('staffproduksi/kategori', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    public function indexgudang()
    {
        $data['kategori'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "kategori";
        $this->load->view('header1');
        $this->load->view('staffgudang/kategori', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
    }


    public function indexpengiriman()
    {
        $data['kategori'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "kategori";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/kategori', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }
    
    public function post()
    {
      $data['title'] = "Tambah Data Kategori";
      $this->load->view('header0');
      $this->load->view('data/post/kategori', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }

    public function postkategori()
    {
      $data['title'] = "Tambah Data Kategori";
      $this->load->view('header1');
      $this->load->view('staffgudang/post/kategori', $data);
      $this->load->view('bargudang');
      $this->load->view('footer');
    }



  
    public function post_process()
    {
        $data = array(
            'nama_kategori'                   => $this->input->post('nama_kategori'),
     
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
        redirect('KategoriClient');
      }



      public function post_processkategori()
    {
        $data = array(
            'nama_kategori'                   => $this->input->post('nama_kategori'),
     
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
        redirect('KategoriClient/indexgudang');
      }




    
    public function put()
    {
        $params = array('id_kategori' =>  $this->uri->segment(3));
        $data['kategori'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Kategori";
        $this->load->view('header0');
        $this->load->view('data/put/kategori', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }



    public function putkategori()
    {
        $params = array('id_kategori' =>  $this->uri->segment(3));
        $data['kategori'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Kategori";
        $this->load->view('header1');
        $this->load->view('staffgudang/put/kategori', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
        
    }


    
    public function put_process()
    {
        $data = array(
            'id_kategori'                   => $this->input->post('id_kategori'),
            'nama_kategori'                   => $this->input->post('nama_kategori'),
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
        redirect('KategoriClient');
    }

    public function put_processkategori()
    {
        $data = array(
            'id_kategori'                   => $this->input->post('id_kategori'),
            'nama_kategori'                   => $this->input->post('nama_kategori'),
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
        redirect('KategoriClient/indexgudang');
    }


    public function delete()
    {
        $params = array('id_kategori' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('KategoriClient');
    }


    public function deletekategori()
    {
        $params = array('id_kategori' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('KategoriClient/indexgudang');
    }
}
?>
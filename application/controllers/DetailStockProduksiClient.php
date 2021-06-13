<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DetailStockProduksiClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        
        $this->API = base_url('detailstockproduksi');
        //$this->API2 = "http://localhost:8080/dummyTA/detailstockproduksi";
        // $this->API2 = "http://localhost:8080/dummyTA/bategori";
    }

    public function index()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "DetailStockProudksiClient";
        $this->load->view('header0');
        $this->load->view('data/detail_produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }
    

    public function indexproduksi()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "barang";
        $this->load->view('header1');
        $this->load->view('staffproduksi/detail_produksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    public function indexgudang()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "barang";
        $this->load->view('header1');
        $this->load->view('staffgudang/detail_produksi', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
    }


    public function indexpengiriman()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "barang";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/detail_produksi', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }




    public function post()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));

      $data['title'] = "Tambah Data Detai Produksi";
      $this->load->view('header0');
      $this->load->view('data/post/detail_stockproduksi', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }


    public function postproduksi()
    {
      $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
      $data['title'] = "Tambah Data Detai Produksi";
      $this->load->view('header1');
      $this->load->view('staffproduksi/post/detail_stockproduksi', $data);
      $this->load->view('barproduksi');
      $this->load->view('footer');
    }

  
    public function post_process()
    {
        $data = array(
            'stock_produksi'            => $this->input->post('stock_produksi'),
            'tanggal_stockproduksi'            => $this->input->post('tanggal_stockproduksi'),
         
        );
        $insert =  $this->curl->simple_post($this->API,$data);
        if ($insert) {
            // echo"berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
        } else {
            // echo"gagal berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
        }
        // var_dump($insert);
        // die;
        redirect('DetailStockProduksiClient');
      }

      public function post_processproduksi()
      {
          $data = array(
              'stock_produksi'            => $this->input->post('stock_produksi'),
              'tanggal_stockproduksi'            => $this->input->post('tanggal_stockproduksi'),
           
          );
          $insert =  $this->curl->simple_post($this->API,$data);
          if ($insert) {
              // echo"berhasil";
              $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
          } else {
              // echo"gagal berhasil";
              $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
          }
          // var_dump($insert);
          // die;
          redirect('DetailStockProduksiClient/indexproduksi');
        }
  

    
    public function put()
    {
        $params = array('id_detailstockproduksi' =>  $this->uri->segment(3));
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Barang";
        $this->load->view('header0');
        $this->load->view('data/put/detail_stockproduksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }

 
    public function putproduksi()
    {
        $params = array('id_detailstockproduksi' =>  $this->uri->segment(3));
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Barang";
        $this->load->view('header1');
        $this->load->view('staffproduksi/put/detail_stockproduksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');

    }

    public function put_process()
    {
        $data = array(
            
            'id_detailstockproduksi'            => $this->input->post('id_detailstockproduksi'),
            'stock_produksi'            => $this->input->post('stock_produksi'),
            'tanggal_stockproduksi'            => $this->input->post('tanggal_stockproduksi'),
            
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
        redirect('DetailStockProduksiClient');
    }



    public function put_processproduksi()
    {
        $data = array(
            
            'id_detailstockproduksi'            => $this->input->post('id_detailstockproduksi'),
            'stock_produksi'            => $this->input->post('stock_produksi'),
            'tanggal_stockproduksi'            => $this->input->post('tanggal_stockproduksi'),
            
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
        redirect('DetailStockProduksiClient/indexproduksi');
    }






    public function delete()
    {
        $params = array('id_detailstockproduksi' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('DetailStockProduksiClient');
    }


    public function deleteproduksi()
    {
        $params = array('id_detailstockproduksi' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('DetailStockProduksiClient/indexproduksi');
    }
}
?>
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DetailProduksiClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
       
        $this->API = base_url('detailproduksi');
        $this->API2 = base_url('produksi');
        

        // $this->API = "http://localhost:8080/dummyTA/detailproduksi";
        // $this->API2 = "http://localhost:8080/dummyTA/produksi";
    }

    public function index()
    {
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "DetailProudksiClient";
        $this->load->view('header0');
        $this->load->view('data/detail_produksi1', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }
    

    public function indexproduksi()
    {
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "DetailProudksiClient";
        $this->load->view('header1');
        $this->load->view('staffproduksi/detail_produksi1', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    public function indexgudang()
    {
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "DetailProudksiClient";
        $this->load->view('header1');
        $this->load->view('staffgudang/detail_produksi1', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
    }


    public function indexpengiriman()
    {
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "DetailProudksiClient";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/detail_produksi1', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }




    public function post()
    {
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['produksi'] = json_decode($this->curl->simple_get($this->API2));

      $data['title'] = "Tambah Data Detai Produksi";
      $this->load->view('header0');
      $this->load->view('data/post/detail_produksi', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }


    // public function postbarang()
    // {
    //  $this->API2 = "http://localhost:8080/dummyTA/kategori";
    //  $data['kategori'] = json_decode($this->curl->simple_get($this->API2));

    //   $data['title'] = "Tambah Data barang";
    //   $this->load->view('header1');
    //   $this->load->view('bar2');
    //   $this->load->view('staffgudang/postbarang', $data);
    //   $this->load->view('footer');
    // }

  
    public function post_process()
    {
        $data = array(
            'nama_staff'            => $this->input->post('nama_staff'),
            'tanggal'            => $this->input->post('tanggal'),
            'shift'            => $this->input->post('shift'),
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
        redirect('DetailProduksiClient');
      }



    //   public function post_processbarang()
    //   {
    //       $data = array(
    //           'nama_barang'            => $this->input->post('nama_barang'),
    //           'nama_kategori'           => $this->input->post('nama_kategori'),
    //           'total'                  => $this->input->post('total'),
    //           'tanggal'                  => $this->input->post('tanggal'),
       
    //       );
    //       $insert =  $this->curl->simple_post($this->API,$data);
    //       if ($insert) {
    //           // echo"berhasil";
    //           $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
    //       } else {
    //           // echo"gagal berhasil";
    //           $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
    //       }
    //       // print_r($insert);
    //       // die;
    //       redirect('barangclient/index2');
    //     }



    
    public function put()
    {
        $params = array('id_detailproduksi' =>  $this->uri->segment(3));
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Detail Produksi";
        $this->load->view('header0');
        $this->load->view('data/put/detail_produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }
    public function putproduksi()
    {
        $params = array('id_detailproduksi' =>  $this->uri->segment(3));
        $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data Detail Produksi";
        $this->load->view('barproduksi');
        $this->load->view('staffproduksi/put/detail_produksi', $data);
        $this->load->view('header1');
        $this->load->view('footer');

    }


    // public function putbarang()
    // {
    //     $params = array('id_barang' =>  $this->uri->segment(3));
    //     $data['barang'] = json_decode($this->curl->simple_get($this->API, $params));
    //     $data['title'] = "Edit Data Barang";
    //     $this->load->view('header1');
    //     $this->load->view('bar2');
    //     $this->load->view('staffgudang/putbarang', $data);
    //     $this->load->view('footer');

    // }


    public function put_process()
    {
        $data = array(
            
            'id_detailproduksi'              => $this->input->post('id_detailproduksi'),
            'id_produksi'                    => $this->input->post('id_produksi'),
            'tanggal'                        => $this->input->post('tanggal'),
            'nama_staff'                     => $this->input->post('nama_staff'),
            'shift'                          => $this->input->post('shift'),
            
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
        redirect('DetailProduksiClient');
    }
    public function put_processproduksi()
    {
        $data = array(
            
            'id_detailproduksi'              => $this->input->post('id_detailproduksi'),
            'id_produksi'                    => $this->input->post('id_produksi'),
            'tanggal'                        => $this->input->post('tanggal'),
            'nama_staff'                     => $this->input->post('nama_staff'),
            'shift'                          => $this->input->post('shift'),
            
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
        redirect('DetailProduksiClient/indexproduksi');
    }



    // public function put_processbarang()
    // {
    //     $data = array(
            
    //         'id_barang'            => $this->input->post('id_barang'),
    //         'nama_barang'            => $this->input->post('nama_barang'),
    //         'nama_kategori'           => $this->input->post('nama_kategori'),
    //         'total'                  => $this->input->post('total'),
    //         'tanggal'                  => $this->input->post('tanggal'),
    //     );
        
    //     $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));
    //     if ($update) {
    //         echo"berhasil";
    //         // $this->session->set_flashdata('result', 'Update Data kategori Berhasil');
    //     } else {
    //         echo"gagal";
    //         // $this->session->set_flashdata('result', 'Update Data kategori Gagal');
    //     }
    //     // print_r($update);
    //     // die;
    //     redirect('barangclient/index2');
    // }





    public function delete( $id )
    {
        $params = array('id_detailproduksi' =>  $id);
        $this->db->where( $params )->delete('detail_produksi');

        
        // $delete =  $this->curl->simple_delete($this->API, $params);
        // if ($delete) {
        //     $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        // } else {
        //     $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        // }
        // print_r($delete);
        // die;
        redirect('DetailProduksiClient');
    }
    public function deleteproduksi()
    {
        $params = array('id_detailproduksi' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('DetailProduksiClient/indexproduksi');
    }



//     public function deletebarang()
//     {
//         $params = array('id_barang' =>  $this->uri->segment(3));
//         $delete =  $this->curl->simple_delete($this->API, $params);
//         if ($delete) {
//             $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
//         } else {
//             $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
//         }
//         // print_r($delete);
//         // die;
//         redirect('barangclient/index2');
//     }







}
?>
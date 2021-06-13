<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PenguranganStockProduksiClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        
        // $this->API = "http://localhost:8080/dummyTA/penguranganstockproduksi";
        // $this->API1 = "http://localhost:8080/dummyTA/stockbarang";

        $this->API = base_url('penguranganstockproduksi');
        $this->API1 = base_url('stockbarang');

    }

    public function index($id_detailproduksi)
    {
        $data['penguranganstockproduksi'] = json_decode($this->curl->simple_get($this->API . '?id_detailproduksi=' . $id_detailproduksi));
        $data['title'] = "Pengurangan Stock Produksi";
        $data['id_detailproduksi'] = $id_detailproduksi;
        $this->load->view('header0');
        $this->load->view('data/penguranganstock_produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }
    public function indexproduksi($id_detailproduksi)
    {
        $data['penguranganstockproduksi'] = json_decode($this->curl->simple_get($this->API . '?id_detailproduksi=' . $id_detailproduksi));
        $data['title'] = "Pengurangan Stock Produksi";
        $data['id_detailproduksi'] = $id_detailproduksi;
        $this->load->view('header1');
        $this->load->view('staffproduksi/penguranganstock_produksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    // public function indexproduksi()
    // {
    //     $data['kategori'] = json_decode($this->curl->simple_get($this->API));
    //     $data['title'] = "kategori";
    //     $this->load->view('header1');
    //     $this->load->view('bar1');
    //     $this->load->view('staffproduksi/kategori', $data);
    //     $this->load->view('footer');
    // }

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
        $this->load->view('bargudang');
        $this->load->view('footer');
    }
    
    public function post($id_detailproduksi)
    {
      $data['title'] = "Pengurangan Stock Produksi";
      $data['detail_semuabarang'] = json_decode($this->curl->simple_get($this->API1));
      $data['id_detailproduksi'] = $id_detailproduksi;
      $data['count'] = $this->input->post('count');

      $this->load->view('header0');
      $this->load->view('data/post/pengurangan_stockproduksi', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }
    public function postproduksi($id_detailproduksi)
    {
      $data['title'] = "Pengurangan Stock Produksi";
      $data['detail_semuabarang'] = json_decode($this->curl->simple_get($this->API1));
      $data['id_detailproduksi'] = $id_detailproduksi;
      $data['count'] = $this->input->post('count');

      $this->load->view('header1');
      $this->load->view('staffproduksi/post/pengurangan_stockproduksi', $data);
      $this->load->view('barproduksi');
      $this->load->view('footer');
    }

    // public function postkategori()
    // {
    //   $data['title'] = "Tambah Data Kategori";
    //   $this->load->view('header1');
    //   $this->load->view('bar2');
    //   $this->load->view('staffgudang/post/kategori', $data);
    //   $this->load->view('footer');
    // }



  
    public function post_process()
    {
        $count = $this->input->post('count');
        
        for ($i=0; $i < $count; $i++) {            
            $data = array(
                'id_detailproduksi'                   => $this->input->post('id_detailproduksi'),
                'jumlah_pengurangan'                   => $this->input->post('jumlah_pengurangan')[$i],
                'id_detailsemuabarang'                   => $this->input->post('id_detailsemuabarang')[$i],
         
            );
    
            $insert =  $this->curl->simple_post($this->API,$data);
    
            $detail_semuabarang = $this->db->get_where('detail_semuabarang', ['id_detailsemuabarang' => $data['id_detailsemuabarang']])->row_array();
    
            $id = $detail_semuabarang['id_detailsemuabarang'];
    
            $data1 = array(
                'tanggal_stockgudang'            => date('Y-m-d'),  
                'stock_pabrik'            => $detail_semuabarang['stock_pabrik'] - $data['jumlah_pengurangan'],
            );
    
            $this->db->where('id_detailsemuabarang', $id);
            $update = $this->db->update('detail_semuabarang', $data1);
        }

        

        if ($insert) {
            // echo"berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
        } else {
            // echo"gagal berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
        }
        // print_r($insert);
        // die;
        redirect('PenguranganStockProduksiClient/index/'. $this->input->post('id_detailproduksi'));
      }
    public function post_processproduksi()
    {
        $count = $this->input->post('count');
        
        for ($i=0; $i < $count; $i++) {            
            $data = array(
                'id_detailproduksi'                   => $this->input->post('id_detailproduksi'),
                'jumlah_pengurangan'                   => $this->input->post('jumlah_pengurangan')[$i],
                'id_detailsemuabarang'                   => $this->input->post('id_detailsemuabarang')[$i],
         
            );
    
            $insert =  $this->curl->simple_post($this->API,$data);
    
            $detail_semuabarang = $this->db->get_where('detail_semuabarang', ['id_detailsemuabarang' => $data['id_detailsemuabarang']])->row_array();
    
            $id = $detail_semuabarang['id_detailsemuabarang'];
    
            $data1 = array(
                'tanggal_stockgudang'            => date('Y-m-d'),  
                'stock_pabrik'            => $detail_semuabarang['stock_pabrik'] - $data['jumlah_pengurangan'],
            );
    
            $this->db->where('id_detailsemuabarang', $id);
            $update = $this->db->update('detail_semuabarang', $data1);
        }

        

        if ($insert) {
            // echo"berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Berhasil Ditambahkan');
        } else {
            // echo"gagal berhasil";
            $this->session->set_flashdata('result', 'Data Kategori Gagal Ditambahkan');
        }
        // print_r($insert);
        // die;
        redirect('PenguranganStockProduksiClient/indexproduksi/'. $this->input->post('id_detailproduksi'));
      }







    
    public function put()
    {
        $id_penguranganstockproduksi = $this->uri->segment(3);
        $data['penguranganstockproduksi'] = json_decode($this->curl->simple_get($this->API . '?id_penguranganstockproduksi=' . $id_penguranganstockproduksi));
        $data['title'] = "Edit Data Pengurangan Stock Produksi";

        $this->load->view('header0');
        $this->load->view('data/put/penguranganstock_produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }
    public function putproduksi()
    {
        $id_penguranganstockproduksi = $this->uri->segment(3);
        $data['penguranganstockproduksi'] = json_decode($this->curl->simple_get($this->API . '?id_penguranganstockproduksi=' . $id_penguranganstockproduksi));
        $data['title'] = "Edit Data Pengurangan Stock Produksi";

        $this->load->view('header1');
        $this->load->view('staffproduksi/put/penguranganstock_produksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');

    }



    // public function putkategori()
    // {
    //     $params = array('id_kategori' =>  $this->uri->segment(3));
    //     $data['kategori'] = json_decode($this->curl->simple_get($this->API, $params));
    //     $data['title'] = "Edit Data Kategori";
    //     $this->load->view('header1');
    //     $this->load->view('bar2');
    //     $this->load->view('staffgudang/put/kategori', $data);
    //     $this->load->view('footer');
        
    // }


    
    public function put_process()
    {
        $data = array(
            'id_penguranganstockproduksi'                   => $this->input->post('id_penguranganstockproduksi'),
            'id_detailproduksi'                   => $this->input->post('id_detailproduksi'),
            'id_detailsemuabarang'                   => $this->input->post('id_detailsemuabarang'),
            'jumlah_pengurangan'                   => $this->input->post('jumlah_pengurangan'),
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

        //uppdate stok
        $detail_semuabarang = $this->db->get_where('detail_semuabarang', ['id_detailsemuabarang' => $data['id_detailsemuabarang']])->row_array();
    
        $id = $detail_semuabarang['id_detailsemuabarang'];

        $data1 = array(
            'tanggal_stockgudang'            => date('Y-m-d'),  
            'stock_pabrik'            => $detail_semuabarang['stock_pabrik'] - ($this->input->post('jumlah_pengurangan') - $this->input->post('jumlah_pengurangan_lama')),
        );
        $this->db->where('id_detailsemuabarang', $id);
        $update = $this->db->update('detail_semuabarang', $data1);

        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data kategori Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data kategori Gagal');
        }
        // print_r($update);
        // die;
        redirect('PenguranganStockProduksiClient/index/' . $this->input->post('id_detailproduksi'));
    }
    public function put_processproduksi()
    {
        $data = array(
            'id_penguranganstockproduksi'                   => $this->input->post('id_penguranganstockproduksi'),
            'id_detailproduksi'                   => $this->input->post('id_detailproduksi'),
            'id_detailsemuabarang'                   => $this->input->post('id_detailsemuabarang'),
            'jumlah_pengurangan'                   => $this->input->post('jumlah_pengurangan'),
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

        //uppdate stok
        $detail_semuabarang = $this->db->get_where('detail_semuabarang', ['id_detailsemuabarang' => $data['id_detailsemuabarang']])->row_array();
    
        $id = $detail_semuabarang['id_detailsemuabarang'];

        $data1 = array(
            'tanggal_stockgudang'            => date('Y-m-d'),  
            'stock_pabrik'            => $detail_semuabarang['stock_pabrik'] - ($this->input->post('jumlah_pengurangan') - $this->input->post('jumlah_pengurangan_lama')),
        );
        $this->db->where('id_detailsemuabarang', $id);
        $update = $this->db->update('detail_semuabarang', $data1);

        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data kategori Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data kategori Gagal');
        }
        // print_r($update);
        // die;
        redirect('PenguranganStockProduksiClient/indexproduksi/' . $this->input->post('id_detailproduksi'));
    }

    // public function put_processkategori()
    // {
    //     $data = array(
    //         'id_kategori'                   => $this->input->post('id_kategori'),
    //         'nama_kategori'                   => $this->input->post('nama_kategori'),
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
    //     redirect('kategoriclient/indexgudang');
    // }


    public function delete()
    {
        $params = array('id_penguranganstockproduksi' =>  $this->uri->segment(4));
        $id_detailproduksi = $this->uri->segment(3);

        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('PenguranganStockProduksiClient/index/' . $id_detailproduksi);
    }
    public function deleteproduksi()
    {
        $params = array('id_penguranganstockproduksi' =>  $this->uri->segment(4));
        $id_detailproduksi = $this->uri->segment(3);

        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('PenguranganStockProduksiClient/indexproduksi/' . $id_detailproduksi);
    }


    // public function deletekategori()
    // {
    //     $params = array('id_kategori' =>  $this->uri->segment(3));
    //     $delete =  $this->curl->simple_delete($this->API, $params);
    //     if ($delete) {
    //         $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
    //     } else {
    //         $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
    //     }
    //     // print_r($delete);
    //     // die;
    //     redirect('kategoriclient/indexgudang');
    // }
}
?>
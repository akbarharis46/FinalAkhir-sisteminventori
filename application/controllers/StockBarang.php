<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class StockBarang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_detailsemuabarang');
        if ($id == '') {
            $stockbarang = $this->db->get('detail_semuabarang')->result();
        } else {
            $this->db->where('id_detailsemuabarang', $id);
            $stockbarang = $this->db->get('detail_semuabarang')->result();
        }
        $this->response($stockbarang, 200);
    }
    function index_post()
    {
        $data = array(
            'tanggal_stockgudang'                 => $this->post('tanggal_stockgudang'),
            'nama_barang'           => $this->post('nama_barang'),
            'stock_pabrik'                 => $this->post('stock_pabrik'),
            
        );
        $insert = $this->db->insert('detail_semuabarang',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
        
    }
    function index_put()
    {
        $id = $this->put('id_detailsemuabarang');
        $data = array(
            
            'tanggal_stockgudang'           => $this->put('tanggal_stockgudang'),
            'nama_barang'           => $this->put('nama_barang'),
            'stock_pabrik'          => $this->put('stock_pabrik'),
            
        );
        $this->db->where('id_detailsemuabarang', $id);
        $update = $this->db->update('detail_semuabarang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_detailsemuabarang');
        $this->db->where('id_detailsemuabarang', $id);
        $delete = $this->db->delete('detail_semuabarang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
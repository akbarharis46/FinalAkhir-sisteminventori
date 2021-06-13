<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class DetailStockProduksi extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_detailstockproduksi');
        if ($id == '') {
            $detailproduksi = $this->db->get('detail_stockproduksi')->result();
        } else {
            $this->db->where('id_detailstockproduksi', $id);
            $detailproduksi = $this->db->get('detail_stockproduksi')->result();
        }
        $this->response($detailproduksi, 200);
    }

    function index_post()
    {
        $data = array(
      'stock_produksi'   => $this->post('stock_produksi'),
      'tanggal_stockproduksi'   => $this->post('tanggal_stockproduksi'),
      
            
        );
        $insert = $this->db->insert('detail_stockproduksi',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()


    {
        $id = $this->put('id_detailstockproduksi');
        $data = array(
            
            'stock_produksi'           => $this->put('stock_produksi'),
            'tanggal_stockproduksi'           => $this->put('tanggal_stockproduksi'),
      
        );
        $this->db->where('id_detailstockproduksi', $id);
        $update = $this->db->update('detail_stockproduksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }



    function index_delete()
    {
        $id = $this->delete('id_detailstockproduksi');
        $this->db->where('id_detailstockproduksi', $id);
        $delete = $this->db->delete('detail_stockproduksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

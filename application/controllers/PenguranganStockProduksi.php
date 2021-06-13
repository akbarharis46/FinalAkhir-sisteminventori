<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PenguranganStockProduksi extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id_detailproduksi = $this->get('id_detailproduksi');
        $id_penguranganstockproduksi = $this->get('id_penguranganstockproduksi');
        if ($id_detailproduksi == '' && $id_penguranganstockproduksi == '') {
            $this->db->select('*');
            $this->db->from('pengurangan_stockproduksi');
            $this->db->join('detail_semuabarang', 'detail_semuabarang.id_detailsemuabarang = pengurangan_stockproduksi.id_detailsemuabarang');
            $pengurangan_stockproduksi = $this->db->get()->result();
        } else if ($id_detailproduksi) {
            $this->db->select('*');
            $this->db->from('pengurangan_stockproduksi');
            $this->db->where('id_detailproduksi', $id_detailproduksi);
            $this->db->join('detail_semuabarang', 'detail_semuabarang.id_detailsemuabarang = pengurangan_stockproduksi.id_detailsemuabarang');
            $pengurangan_stockproduksi = $this->db->get()->result();
        } else if ($id_penguranganstockproduksi) {
            $this->db->select('*');
            $this->db->from('pengurangan_stockproduksi');
            $this->db->where('id_penguranganstockproduksi', $id_penguranganstockproduksi);
            $this->db->join('detail_semuabarang', 'detail_semuabarang.id_detailsemuabarang = pengurangan_stockproduksi.id_detailsemuabarang');
            $pengurangan_stockproduksi = $this->db->get()->row();
        }
        $this->response($pengurangan_stockproduksi, 200);
    }
    function index_post()
    {
        $data = array(
            'id_detailsemuabarang'           => $this->post('id_detailsemuabarang'),
            'id_detailproduksi'           => $this->post('id_detailproduksi'),
            'jumlah_pengurangan'           => $this->post('jumlah_pengurangan'),
            
        );
        $insert = $this->db->insert('pengurangan_stockproduksi',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_penguranganstockproduksi');
        $data = array(
            
            'id_detailproduksi'           => $this->put('id_detailproduksi'),
            'jumlah_pengurangan'           => $this->put('jumlah_pengurangan'),
            'id_detailsemuabarang'           => $this->put('id_detailsemuabarang'),
        );
        $this->db->where('id_penguranganstockproduksi', $id);
        $update = $this->db->update('pengurangan_stockproduksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_penguranganstockproduksi');
        $this->db->where('id_penguranganstockproduksi', $id);
        $delete = $this->db->delete('pengurangan_stockproduksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
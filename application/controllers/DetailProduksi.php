<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class DetailProduksi extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_detailproduksi');
        if ($id == '') {
            $detailproduksi = $this->db->get('detail_produksi')->result();
        } else {
            $this->db->where('id_detailproduksi', $id);
            $detailproduksi = $this->db->get('detail_produksi')->result();
        }
        $this->response($detailproduksi, 200);
    }
    function index_post()
    {
        $data = array(
            'id_produksi'           => $this->post('id_produksi'),
            'nama_staff'           => $this->post('nama_staff'),
            'tanggal'                 => $this->post('tanggal'),
            'shift'                  => $this->post('shift'),
            
        );
        $insert = $this->db->insert('detail_produksi',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_detailproduksi');
        $data = array(
            
            'id_produksi'           => $this->put('id_produksi'),
            'nama_staff'           => $this->put('nama_staff'),
            'tanggal'                  => $this->put('tanggal'),
            'shift'                  => $this->put('shift'),
            
        );
        $this->db->where('id_detailproduksi', $id);
        $update = $this->db->update('detail_produksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_detailproduksi');
        $this->db->where('id_detailproduksi', $id);
        $delete = $this->db->delete('detail_produksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
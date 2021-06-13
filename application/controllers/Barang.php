<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_barang');
        if ($id == '') {
            $barang = $this->db->get('barang')->result();
        } else {
            $this->db->where('id_barang', $id);
            $barang = $this->db->get('barang')->result();
        }
        $this->response($barang, 200);
    }
    function index_post()
    {
        $data = array(
            'nama_kategori'           => $this->post('nama_kategori'),
            'tanggal'                 => $this->post('tanggal'),
            'total'                  => $this->post('total'),
            
        );
        $insert = $this->db->insert('barang',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_barang');
        $data = array(
            
            'nama_kategori'           => $this->put('nama_kategori'),
            'total'                  => $this->put('total'),
            
        );
        $this->db->where('id_barang', $id);
        $update = $this->db->update('barang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_barang');
        $this->db->where('id_barang', $id);
        $delete = $this->db->delete('barang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
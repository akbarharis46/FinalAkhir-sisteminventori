<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Kategori extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_kategori');
        if ($id == '') {
            $kategori = $this->db->get('kategori')->result();
        } else {
            $this->db->where('id_kategori', $id);
            $kategori = $this->db->get('kategori')->result();
        }
        $this->response($kategori, 200);
    }
    function index_post()
    {
        $data = array(
            'nama_kategori'           => $this->post('nama_kategori'),
            
        );
        $insert = $this->db->insert('kategori',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_kategori');
        $data = array(
            
            'nama_kategori'           => $this->put('nama_kategori'),
        );
        $this->db->where('id_kategori', $id);
        $update = $this->db->update('kategori', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_kategori');
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('kategori');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
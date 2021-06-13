<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Produksi extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_produksi');
        if ($id == '') {
            $produksi = $this->db->get('produksi')->result();
        } else {
            $this->db->where('id_produksi', $id);
            $produksi = $this->db->get('produksi')->result();
        }
        $this->response($produksi, 200);
    }
    function index_post()
    {
        $data = array(
            'nama_staff'              => $this->post('nama_staff'),
            'shift'                   => $this->post('shift'),
            'jumlah_produksi'         => $this->post('jumlah_produksi'),
            'tanggal'                 => $this->post('tanggal'),

            
        );
        $insert = $this->db->insert('produksi',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
        // print_r($insert);
        //  exit;
    }
    function index_put()
    {
        $id = $this->put('id_produksi');
        $data = array(
            
            'nama_staff'              => $this->put('nama_staff'),
            'shift'                     => $this->put('shift'),
            'jumlah_produksi'          => $this->put('jumlah_produksi'),
            'tanggal'            => $this->put('tanggal'),
          
            
        );
        $this->db->where('id_produksi', $id);
        $update = $this->db->update('produksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_produksi');
        $this->db->where('id_produksi', $id);
        $delete = $this->db->delete('produksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
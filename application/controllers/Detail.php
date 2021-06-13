<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Detail extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_detailpengiriman');
        if ($id == '') {
            $detail = $this->db->get('detail_pengiriman')->result();
        } else {
            $this->db->where('id_detailpengiriman', $id);
            $detail = $this->db->get('detail_pengiriman')->result();
        }
        $this->response($detail, 200);
    }
    function index_post()
    {
        $data = array(
      'id_pengiriman'   => $this->post('id_pengiriman'),
      'namapengirim'   => $this->post('namapengirim'),
      'no_hp'    => $this->post('no_hp'),
      'jeniskendaraan'         => $this->post('jeniskendaraan'),
      'tujuan_pengiriman'         => $this->post('tujuan_pengiriman'),
      'no_kendaraan'         => $this->post('no_kendaraan'),
      'status'         => $this->post('status'),
      'jumlah_pengiriman'    => $this->post('jumlah_pengiriman'),
      'tanggal_masuk'         => $this->post('tanggal_masuk'),
      'tanggal_diterima'         => $this->post('tanggal_diterima'),
            
        );
        $insert = $this->db->insert('detail_pengiriman',$data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_detailpengiriman');
        $data = array(
            
            'jumlah_pengiriman'           => $this->put('jumlah_pengiriman'),
            'tanggal_masuk'           => $this->put('tanggal_masuk'),
            'tanggal_diterima'           => $this->put('tanggal_diterima'),
        );
        $this->db->where('id_detailpengiriman', $id);
        $update = $this->db->update('detail_pengiriman', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_detailpengiriman');
        $this->db->where('id_detailpengiriman', $id);
        $delete = $this->db->delete('detail_pengiriman');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

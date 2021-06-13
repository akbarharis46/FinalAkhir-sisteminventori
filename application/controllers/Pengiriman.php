<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Pengiriman extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id_pengiriman');
        $id2 = $this->get('id_detailpengiriman');

        if ($id == '') {
            $pengiriman = $this->db->get_where('pengiriman', ['status_pengiriman' => 'Proses Pengiriman'])->result();
        } else {
            $this->db->where('id_pengiriman', $id);
            $pengiriman = $this->db->get_where('pengiriman', ['status_pengiriman' => 'Proses Pengiriman'])->result();
        } 
        if ($id2 != '') {
            
            $this->db->where('id_detailpengiriman', $id2);
            $pengiriman = $this->db->get_where('pengiriman', ['status_pengiriman' => 'Proses Pengiriman'])->result();
        }

        $this->response($pengiriman, 200);
    }
    function index_post()
    {
        $data = array(
            'nama_pengirim'              => $this->post('nama_pengirim'),
            'nomorhp'                    => $this->post('nomorhp'),
            'tujuan'                     => $this->post('tujuan'),
            'jumlah'                     => $this->post('jumlah'),
            'jenis_kendaraan'            => $this->post('jenis_kendaraan'),
            'nomor_kendaraan'            => $this->post('nomor_kendaraan'),
            'tanggal'                    => $this->post('tanggal'),
            'status_pengiriman'          => $this->post('status_pengiriman'),
            
        );
        $insert = $this->db->insert('pengiriman',$data);
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
        $id = $this->put('id_pengiriman');
        $data = array(
            
            'nama_pengirim'              => $this->put('nama_pengirim'),
            'nomorhp'                    => $this->put('nomorhp'),
            'tujuan'                     => $this->put('tujuan'),
            'jumlah'                     => $this->put('jumlah'),
            'jenis_kendaraan'            => $this->put('jenis_kendaraan'),
            'nomor_kendaraan'            => $this->put('nomor_kendaraan'),
            'status_pengiriman'          => $this->put('status_pengiriman'),
            
        );
        $this->db->where('id_pengiriman', $id);
        $update = $this->db->update('pengiriman', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_pengiriman');
        $this->db->where('id_pengiriman', $id);
        $delete = $this->db->delete('pengiriman');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
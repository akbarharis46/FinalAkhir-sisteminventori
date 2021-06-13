<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {            
            $user = $this->db->get('login')->result();
        } else {
            $this->db->where('id', $id);
            $user = $this->db->get('login')->result();
        }
        $this->response($user, 200);
    }

    function index_post()
    {
        $data = array(
            'nama'          => $this->post('nama'),
            'username'      => $this->post('username'),
            'password'      => $this->post('password'),
			'level'         => $this->post('level'),
            
        );
        $insert = $this->db->insert('login', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'nama'             => $this->put('nama'),
            'username'         => $this->put('username'),
            'password'         => $this->put('password'),
            'level'            => $this->put('level'),
            );
        $this->db->where('id', $id);
        $update = $this->db->update('login', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('login');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
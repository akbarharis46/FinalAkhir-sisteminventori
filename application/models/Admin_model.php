<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
public function get_user()
    {
        $this->db->select('id_user,username,password');
        $this->db->from('user');
        $query = $this->db->get();
        if ($query->num_rows() >= 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
   
 public function get_loket()
    {
        $this->db->select('id_loket,loket');
        $this->db->from('loket');
        $this->db->where('status', 'Kosong');
        $query = $this->db->get();
        if ($query->num_rows() >= 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function choice($id_loket)
    {
        $this->db->set('status', 'Kosong');
        $this->db->from('loket');
        $this->db->where('id_loket', $id_loket);                
        $this->db->update();
    }
    function search($startdate,$enddate){
        $this->db->where('id_instansi', 11);
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <', $enddate);
        $antrian = $this->db->get('antrian')->result();
        return $antrian;
    }
    public function insert($tabel,$data)
    {
      $this->db->insert($tabel,$data);
    }  
}
?>
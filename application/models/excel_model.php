<?php

defined('BASEPATH') or exit('No direct script access allowed');

class excel_model extends CI_Model
{
    function fetch_data(){

        $this->db->order_by("id_antrian", "DESC");

        $query = $this->db->get("antrian");

        return $query->result();
    }
}
 	
/* End of file ModelName.php */
?>
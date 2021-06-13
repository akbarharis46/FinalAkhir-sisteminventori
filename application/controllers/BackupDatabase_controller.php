
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class BackupDatabase_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')==NULL){
            redirect('Login','refresh');   
        }
		$this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
	}

	public function backup()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $this->load->dbutil();
        $db_format=array('format'=>'zip','filename'=>'dummyta.sql');
        $backup=& $this->dbutil->backup($db_format);
        $dbname='DB TA ('.date('d-m-Y').').zip';
        $save='assets'.$dbname;
        write_file($save,$backup);
        force_download($dbname,$backup);
    }
}
?>

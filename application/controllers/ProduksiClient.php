<?php

    require('./vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;


defined('BASEPATH') or exit('No direct script access allowed');

class ProduksiClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');


        // new method
        $this->API = base_url('Produksi');
        $this->API1 = base_url('detailproduksi');
        $this->API2 = base_url('detailstockproduksi');
        

        // // old method
        // $this->API = "http://localhost:8080/dummyTA/produksi";
        // $this->API1 = "http://localhost:8080/dummyTA/detailproduksi";
        // $this->API2 = "http://localhost:8080/dummyTA/detailstockproduksi";
    }

    public function index()
    {
        $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API));
        $data['produksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "produksi";

        // var_dump($data['detailstockproduksi']);die;

        $this->load->view('header0');
        $this->load->view('data/produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }
    public function indexproduksi()
    {
        $data['produksi'] = json_decode($this->curl->simple_get($this->API));
        // ---------------------------------
        // filter
        $tanggal_interval = $this->input->get('interval-tanggal');
      
        // apakah user melakuan filter ?
        if ( $tanggal_interval ) {

            $pisah_waktu = explode('-', $tanggal_interval);

            $tanggal_awal = strtotime($pisah_waktu[0]);
            $tanggal_akhir= strtotime($pisah_waktu[1]);
        }

        
        $data_produksi = array();

        // pre-processing
        if ( count($data['produksi']) > 0 ) {

            foreach ( $data['produksi'] AS $item ) {

                $tanggal_produksi = strtotime( $item->tanggal );


                // user melakukan filter
                if ( !empty( $tanggal_interval ) ) {

                    if ( $tanggal_produksi == $tanggal_awal && $tanggal_produksi == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                        array_push( $data_produksi, $item );
                    } else if ( $tanggal_produksi >= $tanggal_awal && $tanggal_produksi <= $tanggal_akhir ) { // apabila memiliki interval waktu
        
                        array_push( $data_produksi, $item );
                    }

                } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                    array_push( $data_produksi, $item );
                }
            }
        }

        // end filter
        // ---------------------------------
        
        $data['title'] = "produksi";
        $data['produksi']   = (object) $data_produksi; // konversi array ke object
        
        $this->load->view('header1');
        $this->load->view('staffproduksi/produksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    public function indexgudang()
    {
        $data['produksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "produksi";
        $this->load->view('header1');
        $this->load->view('staffgudang/produksi', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
    }


    public function indexpengiriman()
    {
        $data['produksi'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "produksi";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/produksi', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }





    public function post()
    {
    
      $data['title'] = "Tambah Data produksi";
      $this->load->view('header0');
      $this->load->view('data/post/produksi', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }


    public function postproduksi()
    {
      $data['title'] = "Tambah Data produksi";
      $this->load->view('header1');
      $this->load->view('staffproduksi/post/produksi', $data);
      $this->load->view('barproduksi');
      $this->load->view('footer');
    }
  
    public function post_process()
    {

        $jml_produksi = $this->input->post('jumlah_produksi');
        $data = array(
            'nama_staff'              => $this->input->post('nama_staff'),
            'shift'                   => $this->input->post('shift'),
            'jumlah_produksi'         => $jml_produksi,
            'tanggal'                 => $this->input->post('tanggal'),
        );
        $insert =  $this->curl->simple_post($this->API,$data);
        
        // update stok barang
        $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);

        $data2 = array(
            'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
            'tanggal_stockproduksi' => date('Y-m-d'),
            'stock_produksi' => $detail_produksi[0]['stock_produksi'] + $this->input->post('jumlah_produksi')
            
        );

        $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));
        if ($insert) {
            echo"berhasil";
        } else {
            echo"gagal ";
        }

        redirect('ProduksiClient');
      }


      
    public function post_processproduksi()
    {

        $jml_produksi = $this->input->post('jumlah_produksi');
        $data = array(
            'nama_staff'              => $this->input->post('nama_staff'),
            'shift'                   => $this->input->post('shift'),
            'jumlah_produksi'         => $jml_produksi,
            'tanggal'                 => $this->input->post('tanggal'),
        );


        $insert =  $this->curl->simple_post($this->API,$data);


        $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);

        $data2 = array(
            'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
            'tanggal_stockproduksi' => date('Y-m-d'),
            'stock_produksi' => $detail_produksi[0]['stock_produksi'] + $this->input->post('jumlah_produksi')
            
        );

        $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));
        if ($insert) {
            echo"berhasil";
        } else {
            echo"gagal ";
        }


        // add notify
        $msg = "Tambahan Data produksi baru sebanyak ". $jml_produksi;
        $dataNotify = [

            'receiver'  => "admin",
            'nama'      => "Tambah Produksi Baru",
            'notes'     => "Penambahan Data Jumlah Produksi Hari Ini  ".$jml_produksi. "Oleh Staff ". $this->input->post('nama_staff')." ".$this->input->post('shift'),
            'url'       => base_url('produksiclient')
        ];
        addNewNotify($dataNotify, $msg);


        redirect('ProduksiClient/indexproduksi');
      }
    

    function test() {

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f94c640978d3a129165b',
            '39bfdc68c91f0dc49e69',
            '1214854',
        $options
        );
        
        $data['message'] = "asd";
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function put()
    {
        $params = array('id_produksi' =>  $this->uri->segment(3));
        $data['produksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data produksi";
        $this->load->view('header0');
        $this->load->view('data/put/produksi', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }

    public function putproduksi()
    {
        $params = array('id_produksi' =>  $this->uri->segment(3));
        $data['produksi'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data produksi";
        $this->load->view('header1');
        $this->load->view('staffproduksi/put/produksi', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');

    }

    public function put_process()
    {
        $data = array(
            'id_produksi'                  => $this->input->post('id_produksi'),
            'nama_staff'              => $this->input->post('nama_staff'),
            'shift'                   => $this->input->post('shift'),
            'jumlah_produksi'         => $this->input->post('jumlah_produksi'),
            'tanggal'                 => $this->input->post('tanggal'),
            
            
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

          // update stok barang
          $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);


          $data2 = array(
              'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
              'tanggal_stockproduksi' => date('Y-m-d'),
              'stock_produksi' => $detail_produksi[0]['stock_produksi'] + ($this->input->post('jumlah_produksi') - $this->input->post('jumlah_produksi_lama'))
              
          );
  
          $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));

        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data produksi Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data produksi Gagal');
        }
        // print_r($update);
        // die;
        redirect('ProduksiClient');
    }



    public function put_processproduksi()
    {
        $data = array(
            'id_produksi'                  => $this->input->post('id_produksi'),
            'nama_staff'              => $this->input->post('nama_staff'),
            'shift'                   => $this->input->post('shift'),
            'jumlah_produksi'         => $this->input->post('jumlah_produksi'),
            'tanggal'                 => $this->input->post('tanggal'),
            
            
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));
        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data produksi Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data produksi Gagal');
        }
        // print_r($update);
        // die;
        redirect('ProduksiClient/indexproduksi');
    }


    public function delete()
    {
        $params = array('id_produksi' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data produksi Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data produksi Gagal');
        }
        // print_r($delete);
        // die;
        redirect('ProduksiClient');
    }
    public function deleteproduksi()

    {
        $params = array('id_produksi' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data kategori Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data kategori Gagal');
        }
        // print_r($delete);
        // die;
        redirect('ProduksiClient/indexproduksi');
    }


public function data_produksikeluar()
{
  $params = array('id_produksi' =>  $this->uri->segment(3));
  $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API2));
  $data['produksi'] = json_decode($this->curl->simple_get($this->API,$params));
  $data['title'] = "Edit Data pengiriman";
  $this->load->view('header0');
  $this->load->view('data/perpindahan_dataproduksi',$data);
  $this->load->view('baradmin');
  $this->load->view('footer');
}



public function data_staffproduksikeluar()
{
  $params = array('id_produksi' =>  $this->uri->segment(3));
  $data['detailproduksi'] = json_decode($this->curl->simple_get($this->API2));
  $data['produksi'] = json_decode($this->curl->simple_get($this->API,$params));
  $data['title'] = "Edit Data pengiriman";
  $this->load->view('header1');
  $this->load->view('staffproduksi/perpindahan_dataproduksi',$data);
  $this->load->view('barproduksi');
  $this->load->view('footer');
}



public function prosesdata_produksikeluar()
{
  $this->load->model('admin_model');
  $this->db->where('id_produksi', 'id_produksi');
  $this->form_validation->set_rules('tanggal','Tanggal Diterima','trim|required');



  // $this->form_validation->set_rules('jumlah_pengiriman-jumlah_pengiriman','Jumlah Pengiriman','trim|required');
  if($this->form_validation->run() === true)
  {
    $id_produksi   = $this->input->post('id_produksi');
    $nama_staff   = $this->input->post('nama_staff');
    $shift    = $this->input->post('shift');
    $tanggal         = $this->input->post('tanggal');
    $jumlah_produksi         = $this->input->post('jumlah_produksi');

    $data1 = array(
            'id_produksi' => $id_produksi,
            'nama_staff' =>$nama_staff,
            'shift' =>$shift,
            'tanggal' =>$tanggal,         
            'jumlah_produksi' =>$jumlah_produksi,         
            
    );

    $insert =   $this->curl->simple_post($this->API1,$data1);

    $data2 = array(
          'id_produksi'                  => $id_produksi,
          'nama_staff'                  => $this->input->post('nama_staff'),
          'shift'                        => $this->input->post('shift'),
          'tanggal'                         => $this->input->post('tanggal'),
          'jumlah_produksi'                         => $this->input->post('jumlah_produksi'),
          
          
      );

      
      $update =  $this->curl->simple_put($this->API, $data2, array(CURLOPT_BUFFERSIZE => 10));

      if($insert){
        //   print_r($update);
        //   exit;
          echo"berhasil";   
          redirect('DetailProduksiClient');
          
        } else {
            echo"gagal";
        }
      } else{
          redirect('DetailProduksiClient');
      }
  }


public function prosesdata_staffproduksikeluar()
{
    $this->load->model('admin_model');
    $this->db->where('id_produksi', 'id_produksi');
    $this->form_validation->set_rules('tanggal','Tanggal Diterima','trim|required');
  
  
  
    // $this->form_validation->set_rules('jumlah_pengiriman-jumlah_pengiriman','Jumlah Pengiriman','trim|required');
    if($this->form_validation->run() === true)
    {
      $id_produksi   = $this->input->post('id_produksi');
      $nama_staff   = $this->input->post('nama_staff');
      $shift    = $this->input->post('shift');
      $tanggal         = $this->input->post('tanggal');
      $jumlah_produksi         = $this->input->post('jumlah_produksi');
  
      $data1 = array(
              'id_produksi' => $id_produksi,
              'nama_staff' =>$nama_staff,
              'shift' =>$shift,
              'tanggal' =>$tanggal,         
              'jumlah_produksi' =>$jumlah_produksi,         
              
      );
  
      $insert =   $this->curl->simple_post($this->API1,$data1);
  
      $data2 = array(
            'id_produksi'                  => $id_produksi,
            'nama_staff'                  => $this->input->post('nama_staff'),
            'shift'                        => $this->input->post('shift'),
            'tanggal'                         => $this->input->post('tanggal'),
            'jumlah_produksi'                         => $this->input->post('jumlah_produksi'),
            
            
        );
  
        
        $update =  $this->curl->simple_put($this->API, $data2, array(CURLOPT_BUFFERSIZE => 10));
  
      if($insert){
        //   print_r($update);
        //   exit;
          echo"berhasil";   
          redirect('DetailProduksiClient/indexproduksi');
          
        } else {
            echo"gagal";
        }
      } else{
          redirect('DetailProduksiClient/indexproduksi');
      }
  }






  // cetak pdf
  function exportToPDF() {

      // header attribute
      $name_file = 'PRODUKSI-'.rand(1, 999999).'-'.date('Y-m-d');
      
      $tanggal_interval = $this->input->get('interval-tanggal');
      
      // apakah user melakuan filter ?
      if ( $tanggal_interval ) {

        $pisah_waktu = explode('-', $tanggal_interval);

        $tanggal_awal = strtotime($pisah_waktu[0]);
        $tanggal_akhir= strtotime($pisah_waktu[1]);
      }
      
    
      
      $pdf = $this->header_attr( $name_file );

      // add a page
      $pdf->AddPage('P', 'A4');


      // Sub header
      $pdf->Ln(5, false);
      $html = '<table border="0">
          <tr>
              <td align="center"><h2>LAPORAN DATA PRODUKSI</h2> <br> </td>
          
          </tr>
  
      
      </table>';

      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Ln(5, false);

      
      

      // header table
      $table_body = "";
      $data['produksi'] = json_decode($this->curl->simple_get($this->API));


    $data_produksi = array();

    // pre-processing
    if ( count($data['produksi']) > 0 ) {

        foreach ( $data['produksi'] AS $item ) {

            $tanggal_produksi = strtotime( $item->tanggal );


            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_produksi == $tanggal_awal && $tanggal_produksi == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                    array_push( $data_produksi, $item );
                } else if ( $tanggal_produksi >= $tanggal_awal && $tanggal_produksi <= $tanggal_akhir ) { // apabila memiliki interval waktu
    
                    array_push( $data_produksi, $item );
                }

            } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                array_push( $data_produksi, $item );
            }
        }
    }


      
      if ( count( $data_produksi ) > 0 ) {

        $i = 1;
        foreach ( $data_produksi AS $item ) {

            $table_body .= '<tr>
            
                <td>'.$i.'</td>
                <td>'.$item->tanggal.'</td>
                <td>'.$item->nama_staff.'</td>
                <td>'.$item->shift.'</td>
                <td>'.$item->jumlah_produksi.'</td>
            
            </tr>';

            $i++;
        }
      }



      $table = '
          <table border="1" width="100%" cellpadding="6">
              <tr>
                  <th width="5%" height="20" padding="5" align="center"><b>No</b></th>
                  <th width="15%" align="center"><b>Tanggal</b></th>
                  <th width="30%" align="center"><b>Nama Staff</b></th>
                  <th width="20%" align="center"><b>Shift Produksi</b></th>
                  <th width="30%" align="center"><b>Hasil Produksi Hari ini</b></th>
          
              </tr>
              '.$table_body.'
          </table>';

      $pdf->writeHTML($table, true, false, true, false, '');



      $pdf->Ln(10, false);
      $ttd = '
          <table border="0">
              <tr>
                  <td colspan="2" align="right">,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.date('Y').'</td>
              </tr>
              <tr>
                  <td colspan="2" height="80"></td>
              </tr>
              <tr>
                  <td width="75%"></td>
                  <td width="20%" align="center">(. . . . . . . . . . . . . . . . .)</td>
              </tr>
          </table>
      ';

      $pdf->writeHTML($ttd, true, false, true, false, '');


      // output
      $pdf->Output($name_file.'.pdf', 'I');
  }





  // header attr
  function header_attr( $title ) {

    // create new PDF document
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Dwi Nur Cahyo');
    $pdf->SetTitle($title);
    // $pdf->SetSubject('TCPDF Tutorial');
    // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('times', '', 10);

    return $pdf;
}

















// Testing Error

// cetak excel
function exportToExcel() {


    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('PT.Milagos')
                ->setLastModifiedBy('Haris')
                ->setTitle('Office 2007 XLSX Test Document')
                ->setSubject('Office 2007 XLSX Test Document')
                ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Test result file');


    
    // Header
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'LAPORAN DATA PRODUKSI');
    $spreadsheet->getActiveSheet()->mergeCells('A1:M1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // set bold
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(14); // set font



    // Subheader
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'Melaporkan hasil pencatatan hasil produksi');
    $spreadsheet->getActiveSheet()->mergeCells('A2:M2');
    $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(false); // set bold
    $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // set font




    // start content
    $style_header_table = array(

        'font' => array('bold' => true, 'size' => 12), // Set font nya jadi bold
        'alignment'      => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
            'top'   => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom'=> array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left'  => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
        )
    );


    $style_body_table = array(

        'font' => array('false' => true, 'size' => 12), // Set font nya jadi bold
        'alignment'      => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
            'top'   => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom'=> array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left'  => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
        )
    );
    



    // header table
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A5', 'No');
    $spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B5', 'Tanggal');
    $spreadsheet->getActiveSheet()->mergeCells('B5:C5');
    $spreadsheet->getActiveSheet()->getStyle('B5:C5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', 'Nama Pengawas');
    $spreadsheet->getActiveSheet()->mergeCells('D5:F5');
    $spreadsheet->getActiveSheet()->getStyle('D5:F5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G5', 'Shift');
    $spreadsheet->getActiveSheet()->mergeCells('G5:H5');
    $spreadsheet->getActiveSheet()->getStyle('G5:H5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('I5', 'Jumlah Produksi');
    $spreadsheet->getActiveSheet()->mergeCells('I5:J5');
    $spreadsheet->getActiveSheet()->getStyle('I5:J5')->applyFromArray($style_header_table);






    // body 
    $baris = 6;
    $urutan = 1;

    $data['produksi'] = json_decode($this->curl->simple_get($this->API));

    // ---------------------------------
        // filter
        $tanggal_interval = $this->input->get('interval-tanggal');
      
        // apakah user melakuan filter ?
        if ( $tanggal_interval ) {

            $pisah_waktu = explode('-', $tanggal_interval);

            $tanggal_awal = strtotime($pisah_waktu[0]);
            $tanggal_akhir= strtotime($pisah_waktu[1]);
        }


        $data_produksi = array();

        // pre-processing
        if ( count($data['produksi']) > 0 ) {

            foreach ( $data['produksi'] AS $item ) {

                $tanggal_produksi = strtotime( $item->tanggal );


                // user melakukan filter
                if ( !empty( $tanggal_interval ) ) {

                    if ( $tanggal_produksi == $tanggal_awal && $tanggal_produksi == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                        array_push( $data_produksi, $item );
                    } else if ( $tanggal_produksi >= $tanggal_awal && $tanggal_produksi <= $tanggal_akhir ) { // apabila memiliki interval waktu
        
                        array_push( $data_produksi, $item );
                    }

                } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                    array_push( $data_produksi, $item );
                }
            }
        }

        // end filter
        // ---------------------------------

    foreach ( $data_produksi AS $isi ) {

        // nomor
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$baris, $urutan);
        $spreadsheet->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_body_table);


        // tanggal
        $kolom_mergetanggal = 'B'.$baris.':C'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$baris, $isi->tanggal);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_mergetanggal );
        $spreadsheet->getActiveSheet()->getStyle($kolom_mergetanggal)->applyFromArray($style_body_table);
        
        
        // nama pengawas
        $kolom_pengawas = 'D'.$baris.':F'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$baris, $isi->nama_staff);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_pengawas );
        $spreadsheet->getActiveSheet()->getStyle($kolom_pengawas)->applyFromArray($style_body_table);
        
        
        // // Shift
        $kolom_shift = 'G'.$baris.':H'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$baris, $isi->shift);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_shift );
        $spreadsheet->getActiveSheet()->getStyle($kolom_shift)->applyFromArray($style_body_table);
        
        
        // // Jumlah Produksi
        $kolom_jml = 'I'.$baris.':J'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$baris, $isi->jumlah_produksi . ' item');
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_jml );
        $spreadsheet->getActiveSheet()->getStyle($kolom_jml)->applyFromArray($style_body_table);


        $urutan++;
        $baris++;
    }
















    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="hasil-laporan.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
}

}
?>
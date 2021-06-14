<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DetailClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        
        $this->API = base_url('detail');
        // $this->API = "http://localhost:8080/dummyTA/detail";
    }

    public function index()
    {
        
        $data['detail'] = json_decode($this->curl->simple_get($this->API));
        
        $tanggal_interval = $this->input->get('interval-tanggal');
      
        // apakah user melakuan filter ?
        if ( $tanggal_interval ) {

            $pisah_waktu = explode('-', $tanggal_interval);

            $tanggal_awal = strtotime($pisah_waktu[0]);
            $tanggal_akhir= strtotime($pisah_waktu[1]);
        }

        $data_detail = array();

        // pre-processing
        if ( count($data['detail']) > 0 ) {

            foreach ( $data['detail'] AS $item ) {

                $tanggal_detail = strtotime( $item->tanggal_diterima);
                

                // user melakukan filter
                if ( !empty( $tanggal_interval ) ) {

                    if ( $tanggal_detail == $tanggal_awal && $tanggal_detail == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                        array_push( $data_detail, $item );
                    } else if ( $tanggal_detail >= $tanggal_awal && $tanggal_detail <= $tanggal_akhir ) { // apabila memiliki interval waktu
        
                        array_push( $data_detail, $item );
                    }

                } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                    array_push( $data_detail, $item );
                }
            }
        }
        
        
        $data['title'] = "Kategori";
        $data['detail']   = (object) $data_detail; // konversi array ke object

        $this->load->view('header0');
        $this->load->view('data/barang_keluar', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }


    public function indexproduksi()
    {
        $data['detail'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "Kategori";
        $this->load->view('header1');
        $this->load->view('staffproduksi/barang_keluar', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');

    }
    public function indexgudang()
    {
        $data['detail'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "Kategori";
        $this->load->view('header1');
        $this->load->view('staffgudang/barang_keluar', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');

    }
    public function indexpengiriman()
    {
        $data['detail'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "Kategori";
        $this->load->view('header1');
        $this->load->view('staffpengiriman/barang_keluar', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');

    }
    


public function delete()
{
    $params = array('id_detailpengiriman' =>  $this->uri->segment(3));
    $delete =  $this->curl->simple_delete($this->API, $params);
    if ($delete) {
        $this->session->set_flashdata('result', 'Hapus Data produksi Berhasil');
    } else {
        $this->session->set_flashdata('result', 'Hapus Data produksi Gagal');
    }
    // print_r($delete);
    // die;
    redirect('DetailClient/index');
}



public function deletestaffpengiriman()
{
    $params = array('id_detailpengiriman' =>  $this->uri->segment(3));
    $delete =  $this->curl->simple_delete($this->API, $params);
    if ($delete) {
        $this->session->set_flashdata('result', 'Hapus Data produksi Berhasil');
    } else {
        $this->session->set_flashdata('result', 'Hapus Data produksi Gagal');
    }
    // print_r($delete);
    // die;
    redirect('DetailClient/indexpengiriman');
}

    


// cetak pdf
function exportToPDF() {



    // header attribute
    $name_file = 'Status Pengiriman-'.rand(1, 999999).'-'.date('Y-m-d');
    
    $tanggal_interval = $this->input->get('interval-tanggal');
      
    // apakah user melakuan filter ?
    if ( $tanggal_interval ) {

      $pisah_waktu = explode('-', $tanggal_interval);

      $tanggal_awal = strtotime($pisah_waktu[0]);
      $tanggal_akhir= strtotime($pisah_waktu[1]);
    }

    $pdf = $this->header_attr( $name_file );

    // add a page
    $pdf->AddPage('L', 'A4');


    // Sub header
    // $pdf->Ln(5, false);
    $html = '<table border="0">
        <tr>
            <td align="center"><h2>LAPORAN STATUS PENGIRIMAN</h2> <br> Lorepisum dolar sit amlet</td>
        
        </tr>

    
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5, false);

    
    

    // header table
    $table_body = "";
    $data['detail'] = json_decode($this->curl->simple_get($this->API));
    
    $data_detail = array();

    // pre-processing
    if ( count($data['detail']) > 0 ) {

        foreach ( $data['detail'] AS $item ) {

            $tanggal_detail = strtotime( $item->tanggal_diterima);
            

            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_detail == $tanggal_awal && $tanggal_detail == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                    array_push( $data_detail, $item );
                } else if ( $tanggal_detail >= $tanggal_awal && $tanggal_detail <= $tanggal_akhir ) { // apabila memiliki interval waktu
    
                    array_push( $data_detail, $item );
                }

            } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                array_push( $data_detail, $item );
            }
        }
    }


    if ( count( $data_detail ) > 0 ) {

      $i = 1;
      foreach ( $data_detail AS $item ) {

          $table_body .= '<tr>
          
              <td>'.$i.'</td>
              <td>'.$item->namapengirim.'</td>
              <td>'.$item->no_hp.'</td>
              <td>'.$item->tujuan_pengiriman.'</td>
              <td>'.$item->jumlah_pengiriman.'</td>
              <td>'.$item->jeniskendaraan.'</td>
              <td>'.$item->no_kendaraan.'</td>
              <td>'.$item->tanggal_masuk.'</td>
              <td>'.$item->tanggal_diterima.'</td>
              <td>'.$item->status.'</td>

          </tr>';

          $i++;
      }
    }



    $table = '
        <table border="1" width="100%" cellpadding="6">
            <tr>
                <th width="5%" height="20" padding="5" align="center"><b>No</b></th>
                <th width="15%" align="center"><b>Nama Pengirim</b></th>
                <th width="10%" align="center"><b>Nomor Hp Petugas</b></th>
                <th width="10%" align="center"><b>Tujuan Pengiriman</b></th>
                <th width="10%" align="center"><b>Jumlah</b></th>
                <th width="10%" align="center"><b>Jenis Kendaraan</b></th>
                <th width="10%" align="center"><b>Nomor Kendaraan</b></th>
                <th width="10%" align="center"><b>Tanggal Pengiriman</b></th>
                <th width="10%" align="center"><b>Tanggal Barang Diterima</b></th>
                <th width="10%" align="center"><b>Status Pengiriman</b></th>
                
        
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

}
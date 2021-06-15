<?php

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

defined('BASEPATH') or exit('No direct script access allowed');



class PengirimanClient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        $this->load->model('admin_model');


        $this->API = base_url('pengiriman');
        $this->API1 = base_url('detail');
        $this->API2 = base_url('detailstockproduksi');
        
        // $this->API = "http://localhost:8080/dummyTA/pengiriman";
        // $this->API1 = "http://localhost:8080/dummyTA/detail";
        // $this->API2 = "http://localhost:8080/dummyTA/detailstockproduksi";
    }

    public function index()
    {
        $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));


        // ---------------------------------
    // filter
    $tanggal_interval = $this->input->get('interval-tanggal');
  
    // apakah user melakuan filter ?
    if ( $tanggal_interval ) {

        $pisah_waktu = explode('-', $tanggal_interval);

        $tanggal_awal = strtotime($pisah_waktu[0]);
        $tanggal_akhir= strtotime($pisah_waktu[1]);
    }


    $data_pengiriman = array();

    // pre-processing
    if ( count($data['pengiriman']) > 0 ) {

        foreach ( $data['pengiriman'] AS $item ) {

            $tanggal_pengiriman = strtotime( $item->tanggal );


            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_pengiriman == $tanggal_awal && $tanggal_pengiriman == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                    array_push( $data_pengiriman, $item );
                } else if ( $tanggal_pengiriman >= $tanggal_awal && $tanggal_pengiriman <= $tanggal_akhir ) { // apabila memiliki interval waktu
    
                    array_push( $data_pengiriman, $item );
                }

            } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                array_push( $data_pengiriman, $item );
            }
        }
    }
        $data['title'] = "pengiriman";
        $data['pengiriman']   = (object) $data_pengiriman; // konversi array ke object

        $this->load->view('header0');
        $this->load->view('data/pengiriman', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');
    }


    public function indexproduksi()
    {
        $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "pengiriman";
        $this->load->view('header1');
        $this->load->view('staffproduksi/pengiriman', $data);
        $this->load->view('barproduksi');
        $this->load->view('footer');
    }

    public function indexgudang()
    {
        $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));
        $data['title'] = "pengiriman";
        $this->load->view('header1');
        $this->load->view('staffgudang/pengiriman', $data);
        $this->load->view('bargudang');
        $this->load->view('footer');
    }


    public function indexstaffpengiriman()
    {
        $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));

        // ---------------------------------
    // filter
    $tanggal_interval = $this->input->get('interval-tanggal');
  
    // apakah user melakuan filter ?
    if ( $tanggal_interval ) {

        $pisah_waktu = explode('-', $tanggal_interval);

        $tanggal_awal = strtotime($pisah_waktu[0]);
        $tanggal_akhir= strtotime($pisah_waktu[1]);
    }


    $data_pengiriman = array();

    // pre-processing
    if ( count($data['pengiriman']) > 0 ) {

        foreach ( $data['pengiriman'] AS $item ) {

            $tanggal_pengiriman = strtotime( $item->tanggal );


            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_pengiriman == $tanggal_awal && $tanggal_pengiriman == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                    array_push( $data_pengiriman, $item );
                } else if ( $tanggal_pengiriman >= $tanggal_awal && $tanggal_pengiriman <= $tanggal_akhir ) { // apabila memiliki interval waktu
    
                    array_push( $data_pengiriman, $item );
                }

            } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                array_push( $data_pengiriman, $item );
            }
        }
    }

        $data['title'] = "pengiriman";
        $data['pengiriman']   = (object) $data_pengiriman; // konversi array ke object
        
        $this->load->view('header1');
        $this->load->view('staffpengiriman/pengiriman', $data);
        $this->load->view('barpengiriman');
        $this->load->view('footer');
    }


    
    public function post()
    {
      $data['title'] = "Tambah Data pengiriman";
      $data['detailstockproduksi'] = json_decode($this->curl->simple_get($this->API2));
      $this->load->view('header0');
      $this->load->view('data/post/pengiriman', $data);
      $this->load->view('baradmin');
      $this->load->view('footer');
    }

  
    public function postpengiriman()
    {
      $data['title'] = "Tambah Data pengiriman";
      $this->load->view('header1');
      $this->load->view('staffpengiriman/post/pengiriman', $data);
      $this->load->view('barpengiriman');
      $this->load->view('footer');
    }
  


    public function post_process()
    {
        $data = array(
            'nama_pengirim'                  => $this->input->post('nama_pengirim'),
            'nomorhp'                  => $this->input->post('nomorhp'),
            'tujuan'                         => $this->input->post('tujuan'),
            'jumlah'                         => $this->input->post('jumlah'),
            'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
            'nomor_kendaraan'                => $this->input->post('nomor_kendaraan'),
            'tanggal'                        => $this->input->post('tanggal'),
            'status_pengiriman'              => $this->input->post('status_pengiriman'),     
        );
        $insert =  $this->curl->simple_post($this->API,$data);

        // Kurangi stok
      $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);


      $data2 = array(
        'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
        'tanggal_stockproduksi' => date('Y-m-d'),
        'stock_produksi' => $detail_produksi[0]['stock_produksi'] - $this->input->post('jumlah')
        
      );
      
      $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));

        if ($insert) {
            echo"berhasil";
            //$this->session->set_flashdata('result', 'Data pengiriman Berhasil Ditambahkan');
        } else {
            echo"gagal ";
            //$this->session->set_flashdata('result', 'Data pengiriman Gagal Ditambahkan');
        }
        // print_r($insert);
        //  exit;
        redirect('PengirimanClient');
      }



      public function post_processpengiriman()
      {
          $data = array(
              'nama_pengirim'                  => $this->input->post('nama_pengirim'),
              'nomorhp'                         => $this->input->post('nomorhp'),
              'tujuan'                         => $this->input->post('tujuan'),
              'jumlah'                         => $this->input->post('jumlah'),
              'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
              'nomor_kendaraan'                => $this->input->post('nomor_kendaraan'),
              'tanggal'                        => $this->input->post('tanggal'),
              'status_pengiriman'              => $this->input->post('status_pengiriman'),     
          );



           $insert =  $this->curl->simple_post($this->API,$data);

        // Kurangi stok
      $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);


      $data2 = array(
        'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
        'tanggal_stockproduksi' => date('Y-m-d'),
        'stock_produksi' => $detail_produksi[0]['stock_produksi'] - $this->input->post('jumlah')
        
      );
      
      $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));
      

        if ($insert) {
            echo"berhasil";
            //$this->session->set_flashdata('result', 'Data pengiriman Berhasil Ditambahkan');
        } else {
            echo"gagal ";
            //$this->session->set_flashdata('result', 'Data pengiriman Gagal Ditambahkan');
        }
        // print_r($insert);
        //  exit;


          // add notify
          $msg = "Tambahan Data Pengiriman  ". $tujuan;
          $dataNotify = [
  
              'receiver'  => "admin",
              'nama'      => "Proses Pengiriman",
              'notes'     => "Pengiriman Barang dengan tujuan  ".$tujuan. "Nama Driver ". $this->input->post('nama_pengirim')."Dengan Nomor Kendaraan ".$this->input->post('nomor_kendaraan'),
              'url'       => base_url('produksiclient')
          ];
          addNewNotify($dataNotify, $msg);
          redirect('PengirimanClient/indexstaffpengiriman');




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
        $params = array('id_pengiriman' =>  $this->uri->segment(3));
        $data['pengiriman'] = json_decode($this->curl->simple_get($this->API, $params));
        $data['title'] = "Edit Data pengiriman";
        $this->load->view('header0');
        $this->load->view('data/put/pengiriman', $data);
        $this->load->view('baradmin');
        $this->load->view('footer');

    }

        public function putpengiriman()
        {
            $params = array('id_pengiriman' =>  $this->uri->segment(3));
            $data['pengiriman'] = json_decode($this->curl->simple_get($this->API, $params));
            $data['title'] = "Edit Data pengiriman";
            $this->load->view('header1');
            $this->load->view('staffpengiriman/put/pengiriman', $data);
            $this->load->view('barpengiriman');
            $this->load->view('footer');
       
        }



    public function put_process()
    {
        $data = array(
            'id_pengiriman'                  => $this->input->post('id_pengiriman'),
            'nama_pengirim'                  => $this->input->post('nama_pengirim'),
            'nomorhp'                        => $this->input->post('nomorhp'),
            'tujuan'                         => $this->input->post('tujuan'),
            'jumlah'                         => $this->input->post('jumlah'),
            'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
            'nomor_kendaraan'                => $this->input->post('nomor_kendaraan'),
            'tanggal'                        => $this->input->post('tanggal'),
            'status_pengiriman'              => $this->input->post('status_pengiriman'),
            
            
        );

        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

        // Kurangi stok
        $detail_produksi = json_decode($this->curl->simple_get($this->API2), true);


        $data2 = array(
            'id_detailstockproduksi' => $detail_produksi[0]['id_detailstockproduksi'],
            'tanggal_stockproduksi' => date('Y-m-d'),
            'stock_produksi' => $detail_produksi[0]['stock_produksi'] - ($this->input->post('jumlah') - $this->input->post('jumlah_lama'))
            
        );

        $update = $this->curl->simple_put($this->API2, $data2, array(CURLOPT_BUFFERSIZE => 10));

        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data pengiriman Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data pengiriman Gagal');
        }
        // print_r($update);
        // die;
        redirect('PengirimanClient');
    }




    
    public function put_processpengiriman()
    {
        $data = array(
            'id_pengiriman'                  => $this->input->post('id_pengiriman'),
            'nama_pengirim'                  => $this->input->post('nama_pengirim'),
            'nomorhp'                        => $this->input->post('nomorhp'),
            'tujuan'                         => $this->input->post('tujuan'),
            'jumlah'                         => $this->input->post('jumlah'),
            'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
            'nomor_kendaraan'                => $this->input->post('nomor_kendaraan'),
            'tanggal'                        => $this->input->post('tanggal'),
            'status_pengiriman'              => $this->input->post('status_pengiriman'),
            
            
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));
        if ($update) {
            echo"berhasil";
            // $this->session->set_flashdata('result', 'Update Data pengiriman Berhasil');
        } else {
            echo"gagal";
            // $this->session->set_flashdata('result', 'Update Data pengiriman Gagal');
        }
        // print_r($update);
        // die;
        redirect('PengirimanClient/indexstaffpengiriman');


    }
    public function delete()
    {
        $params = array('id_pengiriman' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data Pengiriman Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data Pengiriman Gagal');
        }
        // print_r($delete);
        // die;
        redirect('PengirimanClient');
    }

    
    public function deletepengiriman()
    {
        $params = array('id_pengiriman' =>  $this->uri->segment(3));
        $delete =  $this->curl->simple_delete($this->API, $params);
        if ($delete) {
            $this->session->set_flashdata('result', 'Hapus Data Pengiriman Berhasil');
        } else {
            $this->session->set_flashdata('result', 'Hapus Data Pengiriman Gagal');
        }
        // print_r($delete);
        // die;
        redirect('PengirimanClient/indexstaffpengiriman');
    }


    public function barang_keluar()
  {
    $uri = array('id_pengiriman' =>  $this->uri->segment(3));
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API,$uri));
    $data['detail'] = json_decode($this->curl->simple_get($this->API1));
    $data['title'] = "Edit Data pengiriman";
    $this->load->view('header0');
    $this->load->view('data/perpindahan_barang',$data);
    $this->load->view('baradmin');
    $this->load->view('footer');
  }
  
  public function barangkeluar_staffpengiriman()
  {
    $uri = array('id_pengiriman' =>  $this->uri->segment(3));
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API,$uri));
    $data['detail'] = json_decode($this->curl->simple_get($this->API1));
    $data['title'] = "Edit Data pengiriman";
    $this->load->view('header1');
    $this->load->view('staffpengiriman/perpindahan_barang',$data);
    $this->load->view('barpengiriman');
    $this->load->view('footer');
  }



  public function proses_data_keluar()
  {
    $this->load->model('admin_model');
    $this->db->set("jumlah_pengiriman","jumlah_pengiriman - jumlah_pengiriman");
    $this->db->where('id_pengiriman', 'id_pengiriman');
    $this->form_validation->set_rules('tanggal_diterima','Tanggal Diterima','trim|required');
    // $this->form_validation->set_rules('jumlah_pengiriman-jumlah_pengiriman','Jumlah Pengiriman','trim|required');
    if($this->form_validation->run() === true)
    {
      $id_pengiriman   = $this->input->post('id_pengiriman');
      $namapengirim   = $this->input->post('nama_pengirim');
      $no_hp    = $this->input->post('nomorhp');
      $jeniskendaraan         = $this->input->post('jenis_kendaraan');
      $tujuan_pengiriman         = $this->input->post('tujuan');
      $no_kendaraan         = $this->input->post('nomor_kendaraan');
      $status         = $this->input->post('status_pengiriman');
      $jumlah_pengiriman    = $this->input->post('jumlah');
      $tanggal_masuk         = $this->input->post('tanggal');
      $tanggal_diterima         = $this->input->post('tanggal_diterima');

      

      $data1 = array(
              'id_pengiriman' => $id_pengiriman,
              'namapengirim' =>$namapengirim,
              'no_hp' =>$no_hp,
              'jeniskendaraan' =>$jeniskendaraan,         
              'tujuan_pengiriman' =>$tujuan_pengiriman,        
              'no_kendaraan' =>$no_kendaraan,         
              'status' =>$status,         
              'jumlah_pengiriman' => $jumlah_pengiriman,
              'tanggal_masuk' => $tanggal_masuk,
              'tanggal_diterima' => $tanggal_diterima
      );
      $insert =   $this->curl->simple_post($this->API1,$data1);

      $data = array(
            'id_pengiriman'                  => $this->input->post('id_pengiriman'),
            'nama_pengirim'                  => $this->input->post('nama_pengirim'),
            'nomorhp'                        => $this->input->post('nomorhp'),
            'tujuan'                         => $this->input->post('tujuan'),
            'jumlah'                         => $this->input->post('jumlah'),
            'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
            'nomor_kendaraan'                => $this->input->post('nomor_kendaraan'),
            'tanggal'                        => $this->input->post('tanggal'),
            'status_pengiriman'              => $this->input->post('status_pengiriman'),
            
            
        );
        
        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

    //   // add notify
    //   $msg = "Data Pengiriman Sudah Sampai  ". $tujuan_pengiriman;
    //   $dataNotify = [

    //       'receiver'  => "admin",
    //       'nama'      => "Proses Pengiriman",
    //       'notes'     => "Pengiriman Barang dengan tujuan".$tujuan_pengiriman. "Nama Driver". $this->input->post('nama_pengirim')."Dengan Nomor Kendaraan ".$this->input->post('nomor_kendaraan'), "Proses Pengiriman".$this->input->post('status_pengiriman'),
    //       'url'       => base_url('produksiclient'),
    //   ];
    //   addNewNotify($dataNotify, $msg);
    //   redirect('DetailClient/indexstaffpengiriman');

    //   var_dump($insert);
    //   exit;
         if($insert){
             echo"berhasil";   
            redirect('DetailClient');

            } else {
                echo"gagal";
            }
        } else{
            redirect('DetailClient');
        }
    }


    public function proses_data_keluarstaffpengiriman()
    {
      $this->load->model('admin_model');
    //   $this->db->set("jumlah_pengiriman","jumlah_pengiriman - jumlah_pengiriman");
    //   $this->db->where('id_pengiriman', 'id_pengiriman');
      $this->form_validation->set_rules('tanggal_diterima','Tanggal Diterima','trim|required');
      // $this->form_validation->set_rules('jumlah_pengiriman-jumlah_pengiriman','Jumlah Pengiriman','trim|required');
      if($this->form_validation->run() === true)
      {
        $id_pengiriman   = $this->input->post('id_pengiriman');
        $namapengirim   = $this->input->post('nama_pengirim');
        $no_hp    = $this->input->post('nomorhp');
        $jeniskendaraan         = $this->input->post('jenis_kendaraan');
        $tujuan_pengiriman         = $this->input->post('tujuan');
        $no_kendaraan         = $this->input->post('nomor_kendaraan');
        $status         = $this->input->post('status_pengiriman');
        $jumlah_pengiriman    = $this->input->post('jumlah');
        $tanggal_masuk         = $this->input->post('tanggal');
        $tanggal_diterima         = $this->input->post('tanggal_diterima');
  
        
  
        $data1 = array(
                'id_pengiriman' => $id_pengiriman,
                'namapengirim' =>$namapengirim,
                'no_hp' =>$no_hp,
                'jeniskendaraan' =>$jeniskendaraan,         
                'tujuan_pengiriman' =>$tujuan_pengiriman,        
                'no_kendaraan' =>$no_kendaraan,         
                'status' =>$status,         
                'jumlah_pengiriman' => $jumlah_pengiriman,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_diterima' => $tanggal_diterima
        );
        $insert =   $this->curl->simple_post($this->API1,$data1);
        $nama_pengirim = $this->input->post('nama_pengirim');
               
               $nomor_kendaraan = $this->input->post('nomor_kendaraan');
               $status_pengiriman = $this->input->post('status_pengiriman');

        $data = array(
              'id_pengiriman'                  => $this->input->post('id_pengiriman'),
              'nama_pengirim'                  => $nama_pengirim,
              'nomorhp'                        => $this->input->post('nomorhp'),
              'tujuan'                         => $tujuan_pengiriman,
              'jumlah'                         => $jumlah_pengiriman,
              'jenis_kendaraan'                => $this->input->post('jenis_kendaraan'),
              'nomor_kendaraan'                => $nomor_kendaraan,
              'tanggal'                        => $this->input->post('tanggal'),
              'status_pengiriman'              => $status_pengiriman,
              
              
          );
          
          $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

          
  
            // add notify
            
      $msg = "Data Pengiriman Sudah Sampai  ". $tujuan_pengiriman;
      $dataNotify = [

          'receiver'  => "admin",
          'nama'      => "Proses Pengiriman",
          'notes'     => "Pengiriman Barang dengan tujuan  ".$tujuan_pengiriman. "Nama Driver ". $nama_pengirim." dengan Nomor Kendaraan ".$nomor_kendaraan . "Proses Pengiriman".$status_pengiriman,
          'url'       => base_url('DetailClient'),
      ];


      addNewNotify($dataNotify, $msg);
      redirect('DetailClient/indexpengiriman');
  


      //   var_dump($insert);
      //   exit;
           if($insert){
               echo"berhasil";   
              redirect('DetailClient/indexpengiriman');
  
              } else {
                  echo"gagal";
              }
          } else{
              redirect('DetailClient/indexpengiriman');
          }
      }







 // cetak pdf
 function exportToPDF() {



    // header attribute
    $name_file = 'Data Pengiriman-'.rand(1, 999999).'-'.date('Y-m-d');
    
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
            <td align="center"><h2>LAPORAN PENGIRIMAN</h2> <br> Lorepisum dolar sit amlet</td>
        
        </tr>

    
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5, false);

    
    

    // header table
    $table_body = "";
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));
    
    $data_pengiriman = array();

    // pre-processing
    if ( count($data['pengiriman']) > 0 ) {

        foreach ( $data['pengiriman'] AS $item ) {

            $tanggal_pengiriman = strtotime( $item->tanggal );


            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_pengiriman == $tanggal_awal && $tanggal_pengiriman == $tanggal_akhir ) { 

                    array_push( $data_pengiriman, $item );
                } else if ( $tanggal_pengiriman >= $tanggal_awal && $tanggal_pengiriman <= $tanggal_akhir ) {
    
                    array_push( $data_pengiriman, $item );
                }

            } else { 

                array_push( $data_pengiriman, $item );
            }
        }
    }


    if ( count( $data_pengiriman ) > 0 ) {

      $i = 1;
      foreach ( $data_pengiriman AS $item ) {

          $table_body .= '<tr>
          
              <td>'.$i.'</td>
              <td>'.$item->nama_pengirim.'</td>
              <td>'.$item->nomorhp.'</td>
              <td>'.$item->tujuan.'</td>
              <td>'.$item->jumlah.'</td>
              <td>'.$item->jenis_kendaraan.'</td>
              <td>'.$item->nomor_kendaraan.'</td>
              <td>'.$item->tanggal.'</td>
              <td>'.$item->status_pengiriman.'</td>

          </tr>';

          $i++;
      }
    }



    $table = '
        <table border="1" width="100%" cellpadding="6">
            <tr>
                <th width="5%" height="20" padding="5" align="center"><b>No</b></th>
                <th width="20%" align="center"><b>Nama Pengirim</b></th>
                <th width="10%" align="center"><b>Nomor Hp Petugas</b></th>
                <th width="10%" align="center"><b>Tujuan Pengiriman</b></th>
                <th width="10%" align="center"><b>Jumlah</b></th>
                <th width="15%" align="center"><b>Jenis Kendaraan</b></th>
                <th width="10%" align="center"><b>Nomor Kendaraan</b></th>
                <th width="10%" align="center"><b>Tanggal Pengiriman</b></th>
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




// cetak surat jalan
function exportsuratjalan( $id_pengiriman ) {

    // header attribute
    $name_file = 'PENGIRIMAN BARANG-'.rand(1, 999999).'-'.date('Y-m-d');
    $pdf = $this->header_attr( $name_file );

    // add a page
    $pdf->AddPage('L', 'A4');


    // Sub header
    // $pdf->Ln(5, false);
    $html = '<table border="0">
        <tr>
            <td align="center"><h2>SURAT JALAN PENGIRIMAN</h2> <br> Lorepisum dolar sit amlet</td>
        
        </tr>

    
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5, false);

    
    

    // header table
    $table_body = "";
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));

    $params = array('id_pengiriman' =>  $id_pengiriman);
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API, $params));
   
    if ( count( $data['pengiriman'] ) > 0 ) {

        $i = 1;
        foreach ( $data['pengiriman'] AS $item ) {

          $table_body .= '<tr>
          
              <td>'.$i.'</td>
              <td>'.$item->nama_pengirim.'</td>
              <td>'.$item->nomorhp.'</td>
              <td>'.$item->tujuan.'</td>
              <td>'.$item->jumlah.'</td>
              <td>'.$item->jenis_kendaraan.'</td>
              <td>'.$item->nomor_kendaraan.'</td>
              <td>'.$item->tanggal.'</td>
              <td>'.$item->status_pengiriman.'</td>

          </tr>';

          $i++;
      }
    }



    $table = '
        <table border="1" width="100%" cellpadding="6">
            <tr>
                <th width="5%" height="20" padding="5" align="center"><b>No</b></th>
                <th width="20%" align="center"><b>Nama Pengirim</b></th>
                <th width="10%" align="center"><b>Nomor Hp Petugas</b></th>
                <th width="10%" align="center"><b>Tujuan Pengiriman</b></th>
                <th width="10%" align="center"><b>Jumlah</b></th>
                <th width="15%" align="center"><b>Jenis Kendaraan</b></th>
                <th width="10%" align="center"><b>Nomor Kendaraan</b></th>
                <th width="10%" align="center"><b>Tanggal Pengiriman</b></th>
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
    $pdf->SetAuthor('PT MILAGROS');
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
    if (@file_exists(dirname(_FILE_).'/lang/eng.php')) {
        require_once(dirname(_FILE_).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('times', '', 10);

    return $pdf;
}



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


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B5', 'Nama Pengirim');
    $spreadsheet->getActiveSheet()->mergeCells('B5:D5');
    $spreadsheet->getActiveSheet()->getStyle('B5:D5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('E5', 'Nomor HP Petugas');
    $spreadsheet->getActiveSheet()->mergeCells('E5:F5');
    $spreadsheet->getActiveSheet()->getStyle('E5:F5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G5', 'Tujuan');
    $spreadsheet->getActiveSheet()->mergeCells('G5:H5');
    $spreadsheet->getActiveSheet()->getStyle('G5:H5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('I5', 'Jumlah');
    $spreadsheet->getActiveSheet()->mergeCells('I5:J5');
    $spreadsheet->getActiveSheet()->getStyle('I5:J5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('K5', 'Jenis Kendaraan');
    $spreadsheet->getActiveSheet()->mergeCells('K5:L5');
    $spreadsheet->getActiveSheet()->getStyle('K5:L5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('M5', 'Nomor Kendaraan');
    $spreadsheet->getActiveSheet()->mergeCells('M5:N5');
    $spreadsheet->getActiveSheet()->getStyle('M5:N5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('O5', 'Tanggal');
    $spreadsheet->getActiveSheet()->mergeCells('O5:P5');
    $spreadsheet->getActiveSheet()->getStyle('O5:P5')->applyFromArray($style_header_table);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('Q5', 'Status Pengiriman');
    $spreadsheet->getActiveSheet()->mergeCells('Q5:T5');
    $spreadsheet->getActiveSheet()->getStyle('Q5:T5')->applyFromArray($style_header_table);



    // body 
    $baris = 6;
    $urutan = 1;

    // $pengiriman = json_decode($this->curl->simple_get($this->API));
    $data['pengiriman'] = json_decode($this->curl->simple_get($this->API));



    // ---------------------------------
    // filter
    $tanggal_interval = $this->input->get('interval-tanggal');
  
    // apakah user melakuan filter ?
    if ( $tanggal_interval ) {

        $pisah_waktu = explode('-', $tanggal_interval);

        $tanggal_awal = strtotime($pisah_waktu[0]);
        $tanggal_akhir= strtotime($pisah_waktu[1]);
    }


    $data_pengiriman = array();

    // pre-processing
    if ( count($data['pengiriman']) > 0 ) {

        foreach ( $data['pengiriman'] AS $item ) {

            $tanggal_pengiriman = strtotime( $item->tanggal );


            // user melakukan filter
            if ( !empty( $tanggal_interval ) ) {

                if ( $tanggal_pengiriman == $tanggal_awal && $tanggal_pengiriman == $tanggal_akhir ) { // apabila sorting hanya 1 hari

                    array_push( $data_pengiriman, $item );
                } else if ( $tanggal_pengiriman >= $tanggal_awal && $tanggal_pengiriman <= $tanggal_akhir ) { // apabila memiliki interval waktu
    
                    array_push( $data_pengiriman, $item );
                }

            } else { // user tidak menampilkan filter atau menampilkan keseluruhan

                array_push( $data_pengiriman, $item );
            }
        }
    }
    
    foreach ( $data_pengiriman AS $isi ) {

        // nomor
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$baris, $urutan);
        $spreadsheet->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_body_table);


        // nama Pengirim
        $kolom_namapengirim = 'B'.$baris.':C'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$baris, $isi->nama_pengirim);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_namapengirim );
        $spreadsheet->getActiveSheet()->getStyle($kolom_namapengirim)->applyFromArray($style_body_table);
        
        
        // NO HP
        $kolom_nohp = 'D'.$baris.':F'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$baris, $isi->nomorhp);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_nohp );
        $spreadsheet->getActiveSheet()->getStyle($kolom_nohp)->applyFromArray($style_body_table);
        
        
        // Tujuan
        $kolom_tujuan = 'G'.$baris.':H'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$baris, $isi->tujuan);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_tujuan );
        $spreadsheet->getActiveSheet()->getStyle($kolom_tujuan)->applyFromArray($style_body_table);
        
        
        // Jumlah
        $kolom_jml = 'I'.$baris.':J'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$baris, $isi->jumlah . ' item');
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_jml );
        $spreadsheet->getActiveSheet()->getStyle($kolom_jml)->applyFromArray($style_body_table);



        // Jenis Kendaraan
        $kolom_jeniskendaraan = 'K'.$baris.':L'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$baris, $isi->jenis_kendaraan);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_jeniskendaraan );
        $spreadsheet->getActiveSheet()->getStyle($kolom_jeniskendaraan)->applyFromArray($style_body_table);
        
        
        // Nomor Kendaraan
        $kolom_nokendaraan = 'M'.$baris.':N'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('M'.$baris, $isi->nomor_kendaraan);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_nokendaraan );
        $spreadsheet->getActiveSheet()->getStyle($kolom_nokendaraan)->applyFromArray($style_body_table);
        
        
        // Tanggal
        $kolom_tgl = 'O'.$baris.':P'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('O'.$baris, $isi->tanggal);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_tgl );
        $spreadsheet->getActiveSheet()->getStyle($kolom_tgl)->applyFromArray($style_body_table);
        
        
        // Status
        $kolom_status = 'Q'.$baris.':T'.$baris;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('Q'.$baris, $isi->status_pengiriman);
        $spreadsheet->getActiveSheet()->mergeCells( $kolom_status );
        $spreadsheet->getActiveSheet()->getStyle($kolom_status)->applyFromArray($style_body_table);



        $urutan++;
        $baris++;
    }
















    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Laporan Pengiriman.xlsx"');
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
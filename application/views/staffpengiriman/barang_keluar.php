<?php if($this->session->userdata('level')!='Staff Pengiriman'){redirect('login');};?>

<div class="cc">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-microphone" ></i> Data Pengiriman Barang</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-microphone"></i> Pengiriman
        </div>
        <div class="row">
          <div class="col"> 
              <!-- Tabel -->
              <div class="card">
            <!-- /.card-header -->
            <div class="card">
              <div class="card-body" >
                <div class='card-header' style="margin-left:-20px;">
                
                <form action="<?php echo site_url(); ?>DetailClient/exportToPDF/" method="GET">
                <div class="row">
                <div class="col-md-3">

               
                  

                </div>

                <div class="col-md-4">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <!-- <input type="text" name="interval-tanggal" class="form-control float-right" id="aktif-date-range"> -->
                      <input type="text" name="interval-tanggal" class="form-control float-right" id="kt_daterangepicker_1" readonly="readonly">
                    </div>  

                  </div>

                  <div class="col-md-5">
                    <button class=' btn btn-success'>
                      <i class="fa fa-file-excel"></i>
                      <span>
                        Cetak Excel
                      </span>
                    </button>
                   
                    <a class='btn btn-danger' href="<?php echo site_url(); ?>DetailClient/exportToPDF/">
                      <i class="fa fa-file-pdf"></i>
                      <span>
                        Cetak PDF
                      </span>
                  </a> 
                  </div>    
                </div>    
                </form>

                    </div>   
                  <span>
                  <br>
                    <?php
                   if (!empty($this->session->flashdata('pesan')))
                   {
                     ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('pesan');?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <?php   
                  }
                  ?>

                  <?php
                   if (!empty($this->session->flashdata('pesan2')))
                   {
                     ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('pesan2');?>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                 <?php   
                 }
                 ?>

                  <?php
                   if (!empty($this->session->flashdata('pesan3')))
                   {
                     ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('pesan3');?>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                 <?php   
                 }
                 ?>
                 </span> 
                 
              <table id="tabel" class="table table-bordered">
                <thead>
                <tr>
                  <th>NOMOR</th>
                  <th>NAMA PENGIRIM</th>
                  <th>NOMOR HP PETUGAS PENGIRIMAN</th>
                  <th>TUJUAN PENGIRIMAN</th>
                  <th>JUMLAH PENGIRIMAN</th>
                  <th>JENIS KENDARAAN</th>
                  <th>NOMOR KENDARAAn</th>
                  <th>TANGGAL PENGIRIMAN</th>
                  <th>TANGGAL BARANG DITERIMA</th>
                  <th>STATUS PENGIRIMAN</th>
                  <th>AKSI</th>
 
                </tr>
                </thead>
                <tbody>
                <?php 
                  $i=1;

                foreach ($detail as $rows) : ?>
                    <tr>
                        <td><?php echo  $i++; ?></td>

                        
                        <td><?php echo $rows->namapengirim; ?>
                        <td><?php echo $rows->no_hp; ?>
                        <td><?php echo $rows->tujuan_pengiriman; ?>
                        <td><?php echo $rows->jumlah_pengiriman; ?>
                        <td><?php echo $rows->jeniskendaraan; ?>
                        <td><?php echo $rows->no_kendaraan; ?>
                        <td><?php echo $rows->tanggal_masuk; ?>
                        <td><?php echo $rows->tanggal_diterima; ?>
                        <td><?php echo $rows->status; ?>

                        


                            </td>
                        <td>

                        <a href="<?= base_url(); ?>DetailClient/deletestaffpengiriman/<?= $rows->id_detailpengiriman; ?>" class="btn btn-danger" onClick="return confirm('yakin mau hapus');">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>

                            
                            <a href="<?php echo site_url(); ?>#/put/<?php echo $rows->id_detailpengiriman; ?>" class="btn btn-danger">
                            <i class="fa fa-book" aria-hidden="true"></i></a>
                           
                        </td>

                        
                    </tr>
                    <?php endforeach ; ?>
                </tbody>
              </table>             
            <!-- /.card-body -->
          </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->

  <script src="<?php echo base_url('assets')?>/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
<?php if($this->session->userdata('level')!='Staff Produksi'){redirect('login');};?>

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
            <div class="card-body" >
                    <div class='card-header' style="margin-left:-20px;">
          

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
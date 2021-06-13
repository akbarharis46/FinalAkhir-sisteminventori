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
           <!-- /.card-header -->
           
           <div class="card">
              <div class="card-body" >
                <div class='card-header' style="margin-left:-20px;">
                
                <form action="<?php echo site_url(); ?>ProduksiClient/exportToPDF/" method="GET">
                <div class="row">
                <div class="col-md-3">

                  
                  <a class='btn btn-primary' href="<?php echo site_url(); ?>PengirimanClient/postpengiriman">
                  <i class ="fa fa-plus" ></i>
                  <span >
                      Tambah
                  </span>
                  </button>
                  </a>
                  

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
                   
                    <a class='btn btn-danger' href="<?php echo site_url(); ?>PengirimanClient/exportToPDF/">
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
                  <th>NOMOR KENDARAAN</th>
                  <th>TANGGAL</th>
                  <th>STATUS PENGIRIMAN</th>
                  <th>AKSI</th>
 
                </tr>
                </thead>
                <tbody>
                <?php 
                  $i=1;

                foreach ($pengiriman as $rows) : ?>
                    <tr>
                        <td><?php echo  $i++; ?></td>
                        <td><?php echo $rows->nama_pengirim; ?>
                        <td><?php echo $rows->nomorhp; ?>
                        <td><?php echo $rows->tujuan; ?>
                        <td><?php echo $rows->jumlah; ?>
                        <td><?php echo $rows->jenis_kendaraan; ?>
                        <td><?php echo $rows->nomor_kendaraan; ?>
                        <td><?php echo $rows->tanggal; ?>
                        <td><?php echo $rows->status_pengiriman; ?>


                            </td>
                        <td>
                        <a href="<?php echo site_url(); ?>PengirimanClient/putpengiriman/<?php echo $rows->id_pengiriman; ?>" class="btn btn-warning">
                            <i class="fa fa-pen" aria-hidden="true"></i></a>


                            <a href="<?= base_url(); ?>PengirimanClient/deletepengiriman/<?= $rows->id_pengiriman; ?>" class="btn btn-danger" onClick="return confirm('yakin mau hapus');">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>


                            <a class='btn btn-danger' href="<?php echo site_url(); ?>PengirimanClient/exportsuratjalan/<?= $rows->id_pengiriman ?>">
            			          <i class="fa fa-file-pdf"></i>
                            

                            <a class="btn btn-success "  href="<?=base_url();?>PengirimanClient/barangkeluar_staffpengiriman/<?= $rows->id_pengiriman;?>">
                            <i class="ion-android-exit" aria-hidden="true"></i></a> 
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

<script>

</script>
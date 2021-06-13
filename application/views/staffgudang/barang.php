<?php if($this->session->userdata('level')!='Staff Gudang'){redirect('login');};?>

<div class="cc">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-microphone" ></i> Data barang</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-microphone"></i> barang
        </div>
        <div class="row">
          <div class="col"> 
              <!-- Tabel -->
              <div class="card">
            <!-- /.card-header -->
            <div class="card">
              <div class="card-body" >
                <div class='card-header' style="margin-left:-20px;">
                
                <form action="<?php echo site_url(); ?>BarangClient/exportToExcel/" method="GET">
                <div class="row">
                <div class="col-md-3">
                  <button class='btn btn-primary' type='button' data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-plus"></i>
                  <span >
                      Tambah
                  </span>
                  </button>

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
                    <button class='btn btn-danger'>
                      <i class="fa fa-file-excel"></i>
                      <span>
                        Cetak Excel
                      </span>
                    </button>
                    
                    <a class='btn btn-success' href="<?php echo site_url(); ?>BarangClient/exportToPDF/">
                      <i class="fa fa-file-pdf"></i>
                      <span>
                        Cetak PDF
                      </span>
                  </a> 
                  </div>    
                </div>    
                </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Masukkan Jumlah Barang Yang Akan Di Tambahkan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo site_url(); ?>BarangClient/postbarang/" method="post">
                            <div class="form-group">
                              <label for="count">Jumlah</label>
                              <input type="number" class="form-control" id="count" name="count" aria-describedby="count" placeholder="Jumlah" value=1>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>

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
                  <th>No </th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Barang Masuk</th>
                  <th>Aksi</th>
                 
                </tr>
                </thead>
                <tbody>
                <?php 
                $i=1;
                foreach ($barang as $rows) : ?>
                    <tr>
                        <td><?php echo  $i++; ?></td>
                        <td><?php echo $rows->tanggal; ?> </td>
                        <td><?php echo $rows->nama_kategori; ?> </td>
                        <td><?php echo $rows->total; ?>
                            </td>
                    
                        <td>
                            <a href="<?php echo site_url(); ?>BarangClient/putbarang/<?php echo $rows->id_barang; ?>" class="btn btn-warning">
                            <i class="fa fa-pen" aria-hidden="true"></i></a>
                            <a href="<?= base_url(); ?>BarangClient/deletebarang/<?= $rows->id_barang; ?>" class="btn btn-danger" onClick="return confirm('yakin mau hapus');">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
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
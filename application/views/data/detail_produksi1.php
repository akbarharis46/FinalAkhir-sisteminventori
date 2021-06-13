<?php if($this->session->userdata('level')!='admin' && 'Staff Produksi'){redirect('login');};?>

<div class="cc">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-microphone" ></i> Data Kategori Barang</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-microphone"></i> Kategori
        </div>
        <div class="row">
          <div class="col"> 
              <!-- Tabel -->
              <div class="card">
            <!-- /.card-header -->
            <div class="card-body" >
                <div class='card-header' style="margin-left:-20px;">
                <a class='btn btn-primary'href="<?php echo site_url(); ?>DetailProduksiClient/post/">
                    <i class="fa fa-plus"></i>
                    <span >
                        Tambah
                    </span>
                    </a>

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
                  <th>TANGGAL</th>
                  <th>NAMA STAFF</th>
                  <th>SHIFT PRODUKSI</th>
                  <th>AKSI</th>

                 
                </tr>
                </thead>
                <tbody>
                <?php 
                  $i=1;

                foreach ($detailproduksi as $rows) : ?>
                    <tr>
                        <td><?php echo  $i++; ?></td>
                        <td><?php echo $rows->tanggal; ?>
                        <td><?php echo $rows->nama_staff; ?>
                        <td><?php echo $rows->shift; ?>
                            </td>
                        <td>
                            <a href="<?php echo site_url(); ?>DetailProduksiClient/put/<?php echo $rows->id_detailproduksi; ?>" class="btn btn-warning">
                            <i class="fa fa-pen" aria-hidden="true"></i></a>

                            <a href="<?php echo site_url(); ?>PenguranganStockProduksiClient/index/<?php echo $rows->id_detailproduksi; ?>" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true" ></i></a>


                            <a href="<?= base_url(); ?>DetailProduksiClient/delete/<?= $rows->id_detailproduksi; ?>" class="btn btn-danger" onClick="return confirm('Apakah Yakin Untuk Menghapus Data?');">
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
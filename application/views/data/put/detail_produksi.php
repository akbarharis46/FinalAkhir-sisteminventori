<?php if($this->session->userdata('level')!='admin'){redirect('login');};?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<div class="cc" style="width:1300px">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-tablet" ></i> Data Barang</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-tablet"></i> Barang&nbsp; > <i class="nav-icon fas fa-pen"></i>Update Penduduk
        </div>
            <form action="<?php echo site_url(); ?>DetailProduksiClient/put_process"  class="needs-validation" method="POST" enctype="multipart/form-data" onload="setSelectBoxByText()" >
                 <?php foreach ($detailproduksi as $rows) : ?>
                        <div class="form-group">
                                <label for="id_detailproduksi">Id Detail :</label>
                                <input type="text" class="form-control" name="id_detailproduksi" id="selected"value="<?php echo $rows->id_detailproduksi;?>" readonly>

                            </div>
           
                            <div class="form-group">
                            <label for="id_produksi" >ID Produksi :</label>
                                <input type="text" class="form-control" name="id_produksi" id="selected"value="<?php echo $rows->id_produksi;?>" readonly>
                        </div>
                            
                            <div class="form-group">
                            <label for="tanggal" >Kategori :</label>
                                <input type="date" class="form-control" name="tanggal" id="selected"value="<?php echo $rows->tanggal;?>"placeholder="tanggal"  name="tanggal"  >
                        </div>
                       
                        <div class="form-group">
                                <label for="nama_staff">Nama Staff :</label>
                                <input type="text" class="form-control" id="nama_staff" name="nama_staff" value="<?php echo $rows->nama_staff;?>"placeholder="nama_staff"  name="nama_staff"  >
                        </div>


                        <div class="form-group">
                                <label for="shift">shift :</label>
                                <input type="text" class="form-control" id="shift" value="<?php echo $rows->shift;?>"placeholder="shift"  name="shift"  >
                        </div>
                        
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                                    Update
                                </button>
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Apa anda yakin ingin mengupdate data ini ?</p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning">Update</button>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
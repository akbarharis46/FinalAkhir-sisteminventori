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
            <form action="<?php echo site_url(); ?>BarangClient/put_process"  class="needs-validation" method="POST" enctype="multipart/form-data" onload="setSelectBoxByText()" >
                 <?php foreach ($barang as $rows) : ?>
                      <input type="hidden" name="id_barang" value="<?php echo $rows->id_barang;?>">


                            
                            <div class="form-group">
                            <label for="sel1" >Kategori :</label>
                                <input type="text" class="form-control" name="nama_kategori" id="selected"value="<?php echo $rows->nama_kategori;?>" readonly>
                        </div>
                       
                        <div class="form-group">
                                <label for="nama_kategori">Nama Barang :</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $rows->nama_kategori;?>"placeholder="nama_kategori"  name="nama_barang"  >
                        </div>


                        <div class="form-group">
                                <label for="total">Total :</label>
                                <input type="text" class="form-control" id="total" value="<?php echo $rows->total;?>"placeholder="total"  name="total"  >
                        </div>
                        <input type="hidden" name="total_lama" value="<?php echo $rows->total;?>">
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
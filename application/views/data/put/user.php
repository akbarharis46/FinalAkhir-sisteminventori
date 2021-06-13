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
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-tablet" ></i> Data User</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-tablet"></i> User&nbsp; > <i class="nav-icon fas fa-pen"></i>Update User
        </div>
                    <form action="<?php echo site_url(); ?>UserClient/put_process" class="needs-validation" method="POST" onload="setSelectBoxByText()">
                        <?php foreach ($user as $rows) : ?>
                            <div class="form-group">
                                <label for="id">ID User :</label>
                                <input type="text" class="form-control" id="id" placeholder="ID" value="<?php echo $rows->id; ?>" name="id" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?php echo $rows->nama; ?>" name="nama" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon :</label>
                                <input type="text" class="form-control" id="nomor_telepon" placeholder="Nomor Telepon" value="<?php echo $rows->nomor_telepon; ?>" name="nomor_telepon" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat :</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $rows->alamat; ?>" name="alamat" required>
                            </div> -->
                            <div class="form-group">
                                <label for="username">Username :</label>
                                <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $rows->username; ?>" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" value="<?php echo $rows->password; ?>" name="password" required>
                            </div>
                            <div class="form-group">
                            <label for="sel1">Level :</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="">Ubah Level</option>
                                <option value="staff produksi">Staff Produksi</option>
                                <option value="staff gudang">Staff Gudang</option>
                                <option value="staff pengiriman">Staff Pengiriman</option>
                            </select>


                            <div class="form-group">
                                <label for="kode_unik">Kode Unik User :</label>
                                <input type="text" class="form-control" id="kode_unik" placeholder="Kode Unik" value="<?php echo $rows->kode_unik; ?>" name="kode_unik" required readonly>
                            </div>


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
  
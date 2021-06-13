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
            <h2 class="m-0 text-primary " ><i class="nav-icon fas fa-tablet" ></i> Data Pengiriman</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-tablet"></i> Pengiriman&nbsp; > <i class="nav-icon fas fa-plus"></i>Tambah Pengiriman
        </div>
                <form action="<?php echo site_url('PengirimanClient/post_process');?>" class="needs-validation" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                            <label for="nama_pengirim">Nama Pengirim  :</label>
                            <input type="text" class="form-control" id="nama_pengirim" placeholder=" Masukkan Nama Pengirim" name="nama_pengirim" required>
                            </div>

                <div class="form-group">

                            <label for="nomorhp">Nomor Hp Petugas Pengirim  : </label>
                            <input type="text" class="form-control" id="nomorhp" placeholder="Masukkan Nomor Handpone" name="nomorhp" >
                            </div>
              
                <div class="form-group">

                            <label for="tujuan">Tujuan Pengiriman Barang  :</label>
                            <input type="text" class="form-control" id="tujuan" placeholder="Masukkan Nama Barang" name="tujuan" >
               </div>

                <div class="form-group">

                            <label for="jumlah_pengiriman_barang">Jumlah Pengiriman Barang  :</label>
                            <input type="text" class="form-control" id="jumlah_pengiriman_barang" placeholder="Masukkan Jumlah Pengiriman" name="jumlah" >
                </div>
                <div class="form-group">

                            <label for="jenis_kendaraan">Jenis Kendaraan  :</label>
                            <input type="text" class="form-control" id="jenis_kendaraan" placeholder="Masukkan Jenis Kendaraan" name="jenis_kendaraan" >
                </div>
                <div class="form-group">

                            <label for="nomor_kendaraan">Nomor Polisi Kendaraan  :</label>
                            <input type="text" class="form-control" id="nomor_kendaraan" placeholder="Masukkan Nomor Kendaraan" name="nomor_kendaraan" >
                </div>


                <div class="form-group">

                            <label for="status_pengiriman">Status Pengiriman :</label>
                            <!-- <input type="option" class="form-control" id="status_pengiriman" placeholder="Pilih Status  Pengiriman" name="status_pengiriman" > -->
                            <select name="status_pengiriman" id="status_pengiriman" class="form-control">
                             <option value="Proses Pengiriman">Proses Pengiriman</option>
                             <option value="Sudah Terkirim">Barang Sudah Sampai</option>
                                      </select>
                            
                            </div>

                <div class="form-group">

                            <label for="tanggal">Tanggal Pengiriman :</label>
                            <input type="date" class="form-control" id="tanggal" placeholder="Masukkan Tanggal Pengiriman" name="tanggal" >
                            </div>
                   
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Apa anda yakin ingin menambah data ini ?</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                                function setSelectBoxByText(eid, etxt) {
                                    var eid = document.getElementById(eid);
                                    for (var i = 0; i < eid.options.length; ++i) {
                                        if (eid.options[i].value === etxt)
                                            eid.options[i].selected = true;
                                    }
                                }
                                var eid = "penduduk";
                                var etxt = document.getElementById("selected").value;
                                document.getElementById("selected").style.display = "none";
                                setSelectBoxByText(eid, etxt)
                            </script>
                </form>
            </div>
        </div>
    </div>
</div>

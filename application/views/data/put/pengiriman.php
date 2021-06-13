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
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-tablet" ></i> Data Pengiriman</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-tablet"></i> Pengiriman &nbsp; > <i class="nav-icon fas fa-pen"></i>Update kategori
        </div>
            <form action="<?php echo site_url(); ?>PengirimanClient/put_process"  class="needs-validation" method="POST" enctype="multipart/form-data" onload="setSelectBoxByText()">
                 <?php foreach ($pengiriman as $rows) : ?>
                            <div class="form-group">
                                <label for="id_pengiriman">ID Pengirim :</label>
                                <input type="text" class="form-control" id="id_pengiriman" value="<?php echo $rows->id_pengiriman; ?>" name="id_pengiriman" required readonly>
                            </div>


                            <div class="form-group">
                                <label for="nama_pengirim">Nama Pengirim :</label>
                                <input type="text" class="form-control" id="nama_pengirim" value="<?php echo $rows->nama_pengirim; ?>" name="nama_pengirim" required  >
                            </div>


                            <div class="form-group">
                                <label for="nama_pengirim">Nomor HP Petugas Pengiriman :</label>
                                <input type="text" class="form-control" id="nomorhp" value="<?php echo $rows->nama_pengirim; ?>" name="nomorhp" required  >
                            </div>


                            <div class="form-group">
                                <label for="tujuan">Tujuan Pengiriman:</label>
                                <input type="text" class="form-control" id="tujuan" value="<?php echo $rows->tujuan; ?>" name="tujuan" required  >
                            </div>


                            <div class="form-group">
                                <label for="jumlah">Jumlah Pengiriman :</label>
                                <input type="hidden" class="form-control" id="jumlah_lama" value="<?php echo $rows->jumlah; ?>" name="jumlah_lama" required  >
                                <input type="text" class="form-control" id="jumlah" value="<?php echo $rows->jumlah; ?>" name="jumlah" required  >
                            </div>


                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan :</label>
                                <input type="text" class="form-control" id="jenis_kendaraan" value="<?php echo $rows->jenis_kendaraan; ?>" name="jenis_kendaraan" required  >
                            </div>


                            <div class="form-group">
                                <label for="nomor_kendaraan">Nomor Kendaraan :</label>
                                <input type="text" class="form-control" id="nomor_kendaraan" value="<?php echo $rows->nomor_kendaraan; ?>" name="nomor_kendaraan" required  >
                            </div>



                            <div class="form-group">
                                <label for="tanggal">Tanggal Pengiriman :</label>
                                <input type="date" class="form-control" id="tanggal" value="<?php echo $rows->tanggal; ?>" name="tanggal" required  >
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
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                            <a  style="color:white">Update </a>

                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Apa anda yakin ingin mengubah data ini ?</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning"><a  style="color:white">Update </a></button>
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
                                var eid = "kategori";
                                var etxt = document.getElementById("selected").value;
                                document.getElementById("selected").style.display = "none";
                                setSelectBoxByText(eid, etxt)
                            </script>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
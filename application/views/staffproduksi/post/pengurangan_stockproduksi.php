<?php if($this->session->userdata('level')!='Staff Produksi'){redirect('login');};?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="<?php echo base_url()?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<div class="cc" style="width:1300px">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-primary" ><i class="nav-icon fas fa-tablet" ></i> Data Pengurangan</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="alert alert-secondary" role="alert">
      <i class="nav-icon fas fa-home"></i> Dashboard &nbsp; &nbsp; > &nbsp;  &nbsp;<i class="nav-icon fas fa-tablet"></i> Pengurangan &nbsp; > <i class="nav-icon fas fa-pen"></i>Update pengurangan
        </div>
            <form action="<?php echo site_url(); ?>PenguranganStockProduksiClient/post_processproduksi"  class="needs-validation" method="POST" role="form" enctype="multipart/form-data" onload="setSelectBoxByText()">
            <input type="hidden" name="id_detailproduksi" value="<?= $id_detailproduksi ?>">
            <input type="hidden" name="count" value="<?= $count ?>">
            
            <?php for ($i = 0; $i < $count; $i++) : ?>
            <div class="form-group">
                <label for="id_detailsemuabarang">Nama Barang <?= $i+1 ?>  :</label>
                <select class="form-control" id="id_detailsemuabarang-<?= $i ?>" name="id_detailsemuabarang[]" >
                    <option value="" selected="">Pilih Barang</option>
                    <?php foreach ($detail_semuabarang as $rows) : ?>
                        <option value="<?php echo $rows->id_detailsemuabarang; ?>"> <?php echo $rows->nama_barang   ; ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                                <label for="jumlah_pengurangan">Jumlah Barang :</label>
                                <input type="number" class="form-control" id="jumlah_pengurangan"  name="jumlah_pengurangan[]" required  >
                            </div>

                        

          </select>
          <hr>

<?php endfor; ?>
</div>  

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                        </div>

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
                                            <button type="submit" class="btn btn-warning"><a  style="color:white">Tambah </a></button>
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(".form_datetime").datetimepicker({
                                format: 'dd/mm/yyyy',
                                autoclose: true,
                                todayBtn: true,
                                pickTime: false,
                                minView: 2,
                            maxView: 4,
                            });
                        </script>
                        
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
                      
                    </form>
                </div>
            </div>
        </div>
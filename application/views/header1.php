<!DOCTYPE html>
<html lang="en">
<?php if($this->session->userdata('level')!=('Staff Produksi' and 'Staff Gudang' and 'Staff Pengiriman')){redirect('login');};?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?php echo base_url();?>css/assets/img/logo_milagros.png">
  <title>SISTEM INFORMASI MANAJEMEN PABRIK</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/fontawesome-free/css/all.min.css' ?>">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/admin/dist/css/adminlte.min.css' ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
</head>

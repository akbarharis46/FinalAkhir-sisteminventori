<?php 


include_once APPPATH . '/third_party/tcpdf/tcpdf.php';
class Pdf extends TCPDF {


     //Page header
     public function Header() {
        // Logo
        $image_file = './assets/admin/img/logo-milagros-new.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        
        // Title
        $this->Ln(3, true);
        $this->setCellMargins(13, 0, 0, 0);
        $this->SetFont('times', 'B', 11);
        $this->Cell(60, 8, 'PT MILAGROS PUTRA MANDIRI BANYUWANGI', 0, 2, 'L', 0, '', 0, false, 'M', 'M');

        $this->SetFont('times', '', 8);
        $this->Cell(0, 6, 'Jl. Raya Kalibaru, Dusun Sumber Beringin, Kalibaru Kulon', 0, 2, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 6, 'Kec. Kalibaru, Kabupaten Banyuwangi, Jawa Timur 68467', 0, 2, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 6, 'Telp. ', 0, 2, 'L', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $date = date('d/m/Y');
        $this->Cell(0, 10, 'Laporan Akun Pengguna | '.$date, 0, 0, 'L');
        
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
    }
}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'third_party/fpdf/fpdf.php');

class PdfController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Spending");
    }

    public function index($fromdate=null, $todate=null, $val=null)
    {
        // Judul dan konten untuk PDF
        $title = "Report";

        // Data untuk tabel
        $header = array('Name Employee', 'Dept', 'Date', 'Value');
        $param = [
            'fromDate' =>$fromdate,
            'toDate' =>$fromdate,
            'value' =>$val,
        ];
       
        $data = $this->Spending->getAllReport($param);

        // Membuat objek PDF
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 10);

        // Menambahkan halaman
        $pdf->AddPage();

        // Mencetak judul dan konten
        $pdf->Cell(0, 10, $title, 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        // $pdf->MultiCell(0, 10, $content);

        // Mencetak tabel
        $pdf->Ln(10);
        foreach ($header as $col) {
            $pdf->Cell(48, 5, $col, 1);
        }
        $pdf->Ln();
        foreach ($data as $row) {
            // $pdf->Cell(50, 5, $col, 1);

            foreach ($row as $col) {
                $pdf->Cell(48, 5, $col, 1);
            }
            $pdf->Ln();
        }

        // Menyimpan dokumen PDF
        $pdf->Output();
    }

}

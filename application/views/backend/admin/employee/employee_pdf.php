<?php
require('./fpdf/fpdf.php');

class PDF extends FPDF
{
    function myCell($w, $h, $x, $t)
    {
        $height = $h/3;
        $first = $height+1;
        $second = $height+$height+$height+2;
        $len = strlen($t);
        if($len > 100)
        {
            $txt = $str_split($t, 100);
            $this->SetX($x);
            $this->Cell($w,$first, $txt[0], '', '', '');
            $this->SetX($x);
            $this->Cell($w,$second, $txt[1], '', '', '');
            $this->SetX($x);
            $this->Cell($w,$h, '', 'LTRB', 0, 'L', 0);
        }
        else
        {
            $this->SetX($x);
            $this->Cell($w, $h, $t, 'LTRB', 0, 'L', 0);
        }
    }

    function Header()
    {
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Employee List',0,0,'C');
        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}

$pdf = new PDF();
// Column headings
$header = "Employee List";
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Ln();


$w = 28;
$h = 16;

$x = $pdf->GetX();
$pdf->myCell(12, $h, $x, 'Serial');
$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Employee ID');
$x = $pdf->GetX();
$pdf->myCell(35, $h, $x, 'Employee Name');
$x = $pdf->GetX();
$pdf->myCell(35, $h, $x, 'Center');
$x = $pdf->GetX();
$pdf->myCell(50, $h, $x, 'Email');
$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Contact');
$pdf->Ln();

$center_permitted = $this->session->userdata('center_permitted');
$expload_center = explode(',', $center_permitted);
$center_length = count($expload_center);
$count = 1;
for($i=0; $i<$center_length;$i++){
$where_employee = array('center_id' => $expload_center[$i]);
$employees= $this->db->get_where('employee', $where_employee)->result_array();
foreach ($employees as $row):

    $this->db->select('*');
    $this->db->from('centers');
    $this->db->where('center_id', $row['center_id']);
    $query_result = $this->db->get();
    $result = $query_result->row();

    $x = $pdf->GetX();
    $pdf->myCell(12, $h, $x, $count++);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $row['employee_id']);
    $x = $pdf->GetX();
    $pdf->myCell(35, $h, $x, $row['employee_name']);
    $x = $pdf->GetX();
    $pdf->myCell(35, $h, $x, $result->center_name);
    $x = $pdf->GetX();
    $pdf->myCell(50, $h, $x, $row['email']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $row['contact_number']);
    $pdf->Ln();
endforeach;
}





$pdf->Output();

?>
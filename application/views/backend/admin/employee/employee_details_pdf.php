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
        $this->Cell(30,10,'Employee Details',0,0,'C');
        $this->Ln(5);
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
$pdf->SetFont('Arial','',12);
$pdf->Ln();


$w = 50;
$h = 16;


$where_employee = array('employee_id' => $employee_id);
$employees= $this->db->get_where('employee', $where_employee)->result_array();
foreach ($employees as $row):
$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Employee ID');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $employee_id);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Employee Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['employee_name']);
$pdf->Ln();

$this->db->select('*');
$this->db->from('centers');
$this->db->where('center_id', $row['center_id']);
$query_result = $this->db->get();
$result = $query_result->row();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Center Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $result->center_name);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Father Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['father_name']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Mother Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['mother_name']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Email Address');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['email']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Contact Number');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['contact_number']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Present Address');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['present_address']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Permanent Address');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['permanent_address']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Spouse Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['spouse_name']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Date Of Birth');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['date_of_birth']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Date Of Joining');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['date_of_joining']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Blood Group');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['blood_group']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Emergency Name');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['em_name']);
$pdf->Ln();

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, 'Emergency Phone');
$x = $pdf->GetX();
$pdf->myCell(140, $h, $x, $row['em_phone']);
$pdf->Ln();
endforeach;

/**
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
*/





$pdf->Output();

?>
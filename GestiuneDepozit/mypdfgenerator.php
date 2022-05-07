<?php
require('C:\xampp\php\pear\PEAR\fpdf182\fpdf.php');
require('connection.php');
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Lista de clienti',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 


$display_heading = array('id_user'=> 'ID Client','name'=> 'Username','email'=> 'E-mail','nr_telefon'=> 'Numar telefon','sex'=> 'Sex','tara'=> 'Tara','tip'=> 'Tip cont',);
 
$result = mysqli_query($con, "SELECT c.id_user, c.name, c.email, c.nr_telefon, c.sex, c.tara, c.tip FROM login c");
$header = mysqli_query($con, "SHOW columns FROM login where field <> 'pass'");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
foreach($header as $heading) {
$pdf->Cell(28,8,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(28,8,$column,1);
}
$pdf->Output();
?>
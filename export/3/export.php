<?php

ob_end_clean();
require('fpdf/fpdf.php');

// Instantiate and use the FPDF class
$pdf = new FPDF('P','mm','A4');

//Add a new page
$pdf->AddPage();

// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);

// Prints a cell with given text
$pdf->MultiCell( 200, 40, "asdknasjnfdjiewnfojqenfjoehfgoewfhjoehfjoefhewofwefsdadsfasdfadfdasf", 1);

// return the generated output
$pdf->Output();

?>

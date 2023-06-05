<?php
require('fpdf.php');
error_reporting(0);
// Create a new PDF instance
$pdf = new FPDF();

// Add a new page to the PDF
$pdf->AddPage();

$pdf->Image('assets/images/kit-logo.png', 10, 3, 40, 20);

$pdf->Ln(15);
$pdf->SetDrawColor(0, 0, 0); // set the color to black
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

// Set the font size and style

$pdf->SetFont('Arial', 'B', 14);

// Write the title to the PDF
if (isset($_GET['dept']) && !empty($_GET['dept'])) {
    // If a department is selected, include it in the report title
    $dept = $_GET['dept'];
    $pdf->Cell(0, 10, "Unassigned Students - $dept Department", 0, 1, 'C');
}

// Add a table to the PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'PRN', 1, 0, 'C');
$pdf->Cell(50, 10, 'Class', 1, 0, 'C');
$pdf->Cell(90, 10, 'Student Name', 1, 1, 'C');

// Fetch data from the database and add it to the PDF
include('config.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$dept = isset($_GET['dept']) && !empty($_GET['dept']) ? $_GET['dept'] : '';
if ($dept) {
    $result = mysqli_query($conn, "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `PRN` NOT IN (SELECT `PRN` FROM assign)");
}

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 10, $row['PRN'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['Class'], 1, 0, 'C');
    $pdf->Cell(90, 10, $row['Name'], 1, 1, 'C');

}

mysqli_close($conn);

// Output the PDF to the browser
$pdf->Output('Student Unassignment Report - ' . $dept . '.pdf', 'D');
?>
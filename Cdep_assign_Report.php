<?php
require('fpdf.php');

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
    $pdf->Cell(0, 10, "Assigned Students to Teachers - $dept Department", 0, 1, 'C');
} else {
    // If no department is selected, display the default report title
    $pdf->Cell(0, 10, 'Assigned Students to Teachers', 0, 1, 'C');
}

// Add a table to the PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'PRN', 1, 0, 'C');
$pdf->Cell(30, 10, 'Class', 1, 0, 'C');
$pdf->Cell(60, 10, 'Student Name', 1, 0, 'C');
$pdf->Cell(10, 10, 'TID', 1, 0, 'C');
$pdf->Cell(60, 10, 'Teacher Name', 1, 1, 'C');

// Fetch data from the database and add it to the PDF
include('config.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$dept = isset($_GET['dept']) && !empty($_GET['dept']) ? $_GET['dept'] : '';
if ($dept) {
    $result = mysqli_query($conn, "SELECT * FROM assign WHERE `Department` = '$dept' ORDER BY TID");
} else {
    $result = mysqli_query($conn, "SELECT * FROM assign");
}

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 10, $row['PRN'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['Class'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['Name'], 1, 0, 'C');
    $pdf->Cell(10, 10, $row['TID'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['tName'], 1, 1, 'C');
}

mysqli_close($conn);

// Output the PDF to the browser
$pdf->Output('Student Assignment Report - ' . $dept . '.pdf', 'D');
?>
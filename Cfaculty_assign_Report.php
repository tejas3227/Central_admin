<?php
require('fpdf.php');

if (
    isset($_GET['AY']) && !empty($_GET['AY'])
    && isset($_GET['dept']) && !empty($_GET['dept'])
) {
    $AY = $_GET['AY'];
    $dept = $_GET['dept'];
}

// Create a new PDF instance
$pdf = new FPDF();

// Add a new page
$pdf->AddPage();

$pdf->Image('assets/images/kit-logo.png', 10, 3, 40, 20);

$pdf->Ln(5);


// Set the font family and size
$pdf->SetFont('helvetica', 'B', 10);

// Print the academic year on the top-right corner
$pdf->Cell(0, 0, 'Academic Year ' . $AY, 0, 0, 'R');
$x = $pdf->GetX() - $pdf->GetStringWidth('Academic Year ' . $AY) - 2;
$y = $pdf->GetY();
$pdf->SetXY($x, $y);


// Add the image
$pdf->Image('assets/images/kit-logo.png', 10, 3, 40, 20);

$pdf->Ln(15);
// Draw a line
$pdf->SetDrawColor(0, 0, 0); // set the color to black
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

$pdf->SetFont('helvetica', 'B', 14);
// Add the heading
$pdf->Cell(0, 12, "Teacher Assignment Report $dept ", 0, 1, 'C');

// Add a line break
$pdf->Ln(2);

// Connect to the database
include('config.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database
$sql = "SELECT t.tid, t.tName, t.Department, COUNT(a.PRN) as num_assigned
        FROM teachinfo t
        LEFT JOIN assign a ON a.TID = t.tid
        WHERE t.Department = '$dept'
        GROUP BY t.tid";

$result = mysqli_query($conn, $sql);

// Loop through the query results and add them to the PDF
if (mysqli_num_rows($result) > 0) {
    // Add the table header
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(15, 20, 'TID', 1, 0, 'C');
    $pdf->Cell(90, 20, 'Name of Teacher', 1, 0, 'C');
    $pdf->Cell(30, 20, 'Department', 1, 0, 'C');
    $pdf->MultiCell(50, 10, 'Number of' . "\n" . 'Students Assigned', 1, 'C');

    // Set the font back to normal
    $pdf->SetFont('helvetica', '', 12);

    // Loop through the results and add each row to the PDF
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(15, 10, $row['tid'], 1, 0, 'C');
        $pdf->Cell(90, 10, $row['tName'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['Department'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['num_assigned'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No records found.', 0, 1, 'C');
}

// Close the database connection
mysqli_close($conn);

// Output the PDF
$pdf->Output('Faculty Assignment Report ' . $dept . '.pdf', 'D');
?>
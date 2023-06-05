<?php
include('config.php');
error_reporting(0);
$dept = $_GET['dept'];
$academic_year = $_GET['academic_year'];

$q1 = "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `Class` = '$academic_year'";

$result1 = mysqli_query($conn, $q1);

// include the PhpSpreadsheet library
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// select the active sheet
$sheet = $spreadsheet->getActiveSheet();

// add the table header row
$sheet->setCellValue('A1', 'PRN');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Department');
$sheet->setCellValue('D1', 'Class');
$sheet->setCellValue('E1', 'Division');
$sheet->setCellValue('F1', 'Roll No');
$sheet->setCellValue('G1', 'Mobile No');
$sheet->setCellValue('H1', 'Alternate Mobile No');
$sheet->setCellValue('I1', 'Email');
$sheet->setCellValue('J1', 'Address');

// get the table data
$rows = array();
while ($show = $result1->fetch_assoc()) {
    $rows[] = $show;
}

// add the table data to the sheet
$rowIndex = 2;
foreach ($rows as $row) {
    $sheet->setCellValue('A' . $rowIndex, $row['PRN']);
    $sheet->setCellValue('B' . $rowIndex, $row['Name']);
    $sheet->setCellValue('C' . $rowIndex, $row['Department']);
    $sheet->setCellValue('D' . $rowIndex, $row['Class']);
    $sheet->setCellValue('E' . $rowIndex, $row['Division']);
    $sheet->setCellValue('F' . $rowIndex, $row['Roll_Number']);
    $sheet->setCellValue('G' . $rowIndex, $row['Mobile_Number']);
    $sheet->setCellValue('H' . $rowIndex, $row['Alt_Mobile_Number']);
    $sheet->setCellValue('I' . $rowIndex, $row['Email']);
    $sheet->setCellValue('J' . $rowIndex, $row['Address']);
    $rowIndex++;
}

// create a new Xlsx writer object and save the spreadsheet to a file
$writer = new Xlsx($spreadsheet);
$filename = 'Student_Sheet.xlsx';

// tell the browser to expect an Excel file and provide a name for it
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
<?php
include('config.php');

if (isset($_GET['dept']) && !empty($_GET['dept'])) {
    $dept = $_GET['dept'];
    $sql = "SELECT * FROM teachinfo WHERE `Department` = '$dept'";
    $result = mysqli_query($conn, $sql);
}


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// select the active sheet
$sheet = $spreadsheet->getActiveSheet();

// add the table header row
$sheet->setCellValue('A1', 'TID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Department');
$sheet->setCellValue('D1', 'Mobile No');
$sheet->setCellValue('E1', 'Alternate Mobile No');
$sheet->setCellValue('F1', 'Email');
$sheet->setCellValue('G1', 'Address');

// get the table data
$rows = array();
while ($show = $result->fetch_assoc()) {
    $rows[] = $show;
}

// add the table data to the sheet
$rowIndex = 2;
foreach ($rows as $row) {
    $sheet->setCellValue('A' . $rowIndex, $row['tid']);
    $sheet->setCellValue('B' . $rowIndex, $row['tName']);
    $sheet->setCellValue('C' . $rowIndex, $row['Department']);
    $sheet->setCellValue('D' . $rowIndex, $row['Mobile_Number']);
    $sheet->setCellValue('E' . $rowIndex, $row['Alt_Mobile_Number']);
    $sheet->setCellValue('F' . $rowIndex, $row['Email']);
    $sheet->setCellValue('G' . $rowIndex, $row['Address']);
    $rowIndex++;
}

// create a new Xlsx writer object and save the spreadsheet to a file
$writer = new Xlsx($spreadsheet);
$filename = 'teacher_sheet.xlsx';

// tell the browser to expect an Excel file and provide a name for it
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
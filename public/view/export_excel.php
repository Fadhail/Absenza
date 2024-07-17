<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'koneksi.php';

$tanggal = isset($_GET['tanggal']) ? date('Y-m-d', strtotime($_GET['tanggal'])) : date('Y-m-d');
$kelas = isset($_GET['kelas']) && $_GET['kelas'] != '' ? $_GET['kelas'] : 'Semua Kelas';

if ($kelas !== 'Semua Kelas') {
    $sql = $koneksi->prepare("SELECT b.nisn, b.nama, b.kelas, a.tanggal, a.jam_masuk, a.jam_pulang FROM rekapitulasi a INNER JOIN db_siswa b ON a.nokartu = b.nokartu WHERE a.tanggal = ? AND b.kelas = ?");
    $sql->bind_param("ss", $tanggal, $kelas);
} else {
    $sql = $koneksi->prepare("SELECT b.nisn, b.nama, b.kelas, a.tanggal, a.jam_masuk, a.jam_pulang FROM rekapitulasi a INNER JOIN db_siswa b ON a.nokartu = b.nokartu WHERE a.tanggal = ?");
    $sql->bind_param("s", $tanggal);
}

if (!$sql->execute()) {
    die("Query failed: " . $sql->error);
}

$result = $sql->get_result();

if ($result->num_rows == 0) {
    die("No data found for the selected date and class.");
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'NO');
$sheet->setCellValue('B1', 'NISN');
$sheet->setCellValue('C1', 'NAMA');
$sheet->setCellValue('D1', 'KELAS');
$sheet->setCellValue('E1', 'TANGGAL');
$sheet->setCellValue('F1', 'JAM MASUK');
$sheet->setCellValue('G1', 'JAM PULANG');

$row = 2;
$no = 1;
while ($data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['nisn']);
    $sheet->setCellValue('C' . $row, $data['nama']);
    $sheet->setCellValue('D' . $row, $data['kelas']);
    $sheet->setCellValue('E' . $row, $data['tanggal']);
    $sheet->setCellValue('F' . $row, $data['jam_masuk']);
    $sheet->setCellValue('G' . $row, $data['jam_pulang']);
    $row++;
}

$writer = new Xlsx($spreadsheet);

// Buat nama file
$kelas_formatted = str_replace(' ', '_', $kelas); // Ganti spasi dengan underscore
$filename = 'PRESENSI_' . $kelas_formatted . '_' . $tanggal . '.xlsx';

// Output to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit();
?>

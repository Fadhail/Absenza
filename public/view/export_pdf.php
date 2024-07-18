<?php
require_once('../../vendor/tecnickcom/tcpdf/tcpdf.php');

include 'koneksi.php';

$tanggal = isset($_GET['tanggal']) ? date('Y-m-d', strtotime($_GET['tanggal'])) : date('Y-m-d');
$kelas = isset($_GET['kelas']) && $_GET['kelas'] != '' ? $_GET['kelas'] : 'Semua Kelas';

if ($kelas !== 'Semua Kelas') {
    $sql = $koneksi->prepare("SELECT b.nisn, b.nama, b.kelas, a.tanggal, a.status, a.jam_masuk, a.jam_pulang FROM rekapitulasi a INNER JOIN db_siswa b ON a.nokartu = b.nokartu WHERE a.tanggal = ? AND b.kelas = ?");
    $sql->bind_param("ss", $tanggal, $kelas);
} else {
    $sql = $koneksi->prepare("SELECT b.nisn, b.nama, b.kelas, a.tanggal, a.status, a.jam_masuk, a.jam_pulang FROM rekapitulasi a INNER JOIN db_siswa b ON a.nokartu = b.nokartu WHERE a.tanggal = ?");
    $sql->bind_param("s", $tanggal);
}
$sql->execute();
$result = $sql->get_result();

$pdf = new TCPDF();
$pdf->AddPage();

$html = '<h1>Data Absensi Kelas ' . htmlspecialchars($kelas) . ' pada tanggal ' . htmlspecialchars($tanggal) . '</h1>';

$html .= '<table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr style="background-color:#f2f2f2;color:#333333;">
                    <th>NO</th>
                    <th>NISN</th>
                    <th>NAMA</th>
                    <th>KELAS</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th>JAM MASUK</th>
                    <th>JAM PULANG</th>
                </tr>
            </thead>
            <tbody>';

$no = 1;
while ($data = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $data['nisn'] . '</td>
                <td>' . $data['nama'] . '</td>
                <td>' . $data['kelas'] . '</td>
                <td>' . $data['tanggal'] . '</td>
                <td>' . $data['status'] . '</td>
                <td>' . $data['jam_masuk'] . '</td>
                <td>' . $data['jam_pulang'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Format nama file
$kelas_formatted = str_replace(' ', '_', $kelas);
$filename = 'PRESENSI_' . $kelas_formatted . '_' . $tanggal . '.pdf';

$pdf->Output($filename, 'D');
exit();
?>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nokartu = $_POST['nokartu'];
    $status = $_POST['status'];
    $tanggal = date('Y-m-d');

    $cek_rekap = mysqli_query($koneksi, "SELECT * FROM rekapitulasi WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
    if (mysqli_num_rows($cek_rekap) > 0) {
        $update_query = mysqli_query($koneksi, "UPDATE rekapitulasi SET status = '$status' WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
    } else {
        $insert_query = mysqli_query($koneksi, "INSERT INTO rekapitulasi (nokartu, tanggal, status) VALUES ('$nokartu', '$tanggal', '$status')");
    }

    if ($update_query || $insert_query) {
        echo "Status berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui status.";
    }

    header("Location: siswa.php");
    exit();
}
?>

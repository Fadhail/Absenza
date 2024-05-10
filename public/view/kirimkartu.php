<?php 
include "koneksi.php";

// Validasi dan ambil nomor kartu dari permintaan GET
if (isset($_GET['nokartu']) && !empty($_GET['nokartu'])) {
    $nokartu = $_GET['nokartu'];
    
    // Lakukan pembersihan dan sanitasi nomor kartu sebelum digunakan
    $nokartu = mysqli_real_escape_string($koneksi, $nokartu);

    // Kosongkan Tabel RFID
    mysqli_query($koneksi, "DELETE FROM rfid");

    // Simpan no kartu
    $simpan = mysqli_query($koneksi, "INSERT INTO rfid (nokartu) VALUES ('$nokartu')");
    if ($simpan) {
        echo 'Berhasil';
    } else {
        echo 'Gagal';
    }
} else {
    echo 'Nomor kartu tidak valid';
}
?>

<?php
include 'koneksi.php';

$sql = mysqli_query($koneksi, "SELECT * FROM status");
$data = mysqli_fetch_array($sql);

// Check if $data is not null and has 'mode' key
$mode_absen = isset($data['mode']) ? $data['mode'] : null;

// Uji mode absen
$mode = "";
if ($mode_absen == 1) {
    $mode = "Masuk";
} else if ($mode_absen == 2) {
    $mode = "Pulang";
}

// Baca kartu rfid
$baca_kartu = mysqli_query($koneksi, "SELECT * FROM rfid");
$data_kartu = mysqli_fetch_array($baca_kartu);

// Check if $data_kartu is not null and has 'nokartu' key
$nokartu = isset($data_kartu['nokartu']) ? $data_kartu['nokartu'] : "";
?>

<div class="container mx-auto text-center">
    <?php
    if ($nokartu == "") {
    ?>
        <h1 class="text-3xl font-bold mt-8 mb-4">ABSEN : <?php print $mode ?></h1>
        <img class="mx-auto mb-4" src="../img/rfid.png" alt="">
        <div class="text-lg">SILAHKAN TEMPELKAN KARTU</div>

    <?php } else {
        $cari_siswa = mysqli_query($koneksi, "SELECT * FROM db_siswa WHERE nokartu = '$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_siswa);
        // Cek apakah ada siswa
        if ($jumlah_data == 0) {
            echo "<h1 class='text-3xl font-bold mt-8'>KARTU TIDAK TERDAFTAR</h1>";
        }
        else {
            // Ambil data siswa
            $data_siswa = mysqli_fetch_array($cari_siswa);
            $nama = $data_siswa['nama'];

            // Tanggal dan jam hari ini
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            // Cek apakah siswa sudah absen
            $cari_absen = mysqli_query($koneksi, "SELECT * FROM rekapitulasi WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
            $jumlah_absen = mysqli_num_rows($cari_absen);
            if ($jumlah_absen == 0) {
                echo "<h1 class='text-3xl font-bold mt-8'>SELAMAT DATANG <br> $nama</h1>";
                mysqli_query($koneksi, "INSERT INTO rekapitulasi (nokartu, tanggal, jam_masuk) VALUES ('$nokartu', '$tanggal', '$jam')");
            } else {
                // Update sesuai pilihan mode
                if ($mode_absen == 2) {
                    echo "<h1 class='text-3xl font-bold mt-8'>SELAMAT PULANG <br> $nama</h1>";
                    mysqli_query($koneksi, "UPDATE rekapitulasi SET jam_pulang = '$jam' WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
                }
            }

        }

        // Reset kartu
        mysqli_query($koneksi, "DELETE FROM rfid");
    } ?>
</div>


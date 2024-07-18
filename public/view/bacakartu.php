<?php
include 'koneksi.php';

// Ambil data kartu RFID
$baca_kartu = mysqli_query($koneksi, "SELECT * FROM rfid");
$data_kartu = mysqli_fetch_array($baca_kartu);

// Periksa apakah data kartu RFID tidak null dan memiliki kunci 'nokartu'
$nokartu = isset($data_kartu['nokartu']) ? $data_kartu['nokartu'] : "";

?>

<div class="container mx-auto text-center">
    <?php
    // Ambil waktu saat ini
    date_default_timezone_set('Asia/Jakarta');
    $jam = date('H:i:s');

    // Tentukan rentang waktu untuk absen masuk dan pulang
    $jam_masuk_min = '19:00:00';
    $jam_masuk_max = '23:00:00';
    $jam_keluar_min = '15:00:00';
    $jam_keluar_max = '17:00:00';
    
    // Tampilkan heading utama
    echo "<h1 class='text-3xl font-bold mt-8 mb-4'>ABSEN : " . (($jam >= $jam_masuk_min && $jam <= $jam_masuk_max) ? 'Masuk' : (($jam >= $jam_keluar_min && $jam <= $jam_keluar_max) ? 'Pulang' : '')) . "</h1>";

    if ($nokartu == "") {
        // Tampilkan pesan untuk menempelkan kartu
        echo "<img class='mx-auto mb-4' src='../img/rfid.png' alt=''>";
        echo "<div class='text-lg'>SILAHKAN TEMPELKAN KARTU</div>";

    } else {
        // Periksa apakah siswa terdaftar
        $cari_siswa = mysqli_query($koneksi, "SELECT * FROM db_siswa WHERE nokartu = '$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_siswa);

        if ($jumlah_data == 0) {
            // Tampilkan pesan untuk kartu yang tidak terdaftar
            echo "<h1 class='text-3xl font-bold mt-8'>KARTU TIDAK TERDAFTAR</h1>";

        } else {
            // Ambil data siswa
            $data_siswa = mysqli_fetch_array($cari_siswa);
            $nama = $data_siswa['nama'];

            // Ambil tanggal hari ini
            $tanggal = date('Y-m-d');

            // Periksa apakah siswa sudah melakukan absen hari ini
            $cari_absen = mysqli_query($koneksi, "SELECT * FROM rekapitulasi WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
            $jumlah_absen = mysqli_num_rows($cari_absen);

            if ($jumlah_absen == 0) {
                // Periksa apakah sudah masuk dalam rentang waktu absen masuk
                if ($jam >= $jam_masuk_min && $jam <= $jam_masuk_max) {
                    // Rekam waktu masuk
                    echo "<h1 class='text-3xl font-bold mt-8'>SELAMAT DATANG <br> $nama</h1>";
                    mysqli_query($koneksi, "INSERT INTO rekapitulasi (nokartu, tanggal, jam_masuk, status) VALUES ('$nokartu', '$tanggal', '$jam', 'hadir')");
                } else {
                    // Tampilkan pesan jika bukan waktu absen masuk
                    echo "<h1 class='text-3xl font-bold mt-8'>BUKAN WAKTU ABSEN MASUK</h1>";
                }
            } else {
                // Periksa apakah sudah masuk dalam rentang waktu absen pulang
                if ($jam >= $jam_keluar_min && $jam <= $jam_keluar_max) {
                    // Rekam waktu pulang
                    echo "<h1 class='text-3xl font-bold mt-8'>SELAMAT PULANG <br> $nama</h1>";
                    mysqli_query($koneksi, "UPDATE rekapitulasi SET jam_pulang = '$jam' WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
                } else {
                    // Tampilkan pesan jika bukan waktu absen pulang
                    echo "<h1 class='text-3xl font-bold mt-8'>BUKAN WAKTU ABSEN PULANG</h1>";
                }
            }
        }

        // Reset data kartu
        mysqli_query($koneksi, "DELETE FROM rfid");
    }
    ?>
</div>
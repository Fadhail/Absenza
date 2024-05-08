<?php
    include 'koneksi.php';

    $sql = mysqli_query($koneksi, "SELECT * FROM status");
    $data = mysqli_fetch_array($sql);
    $mode_absen = $data['mode'];

    // Uji mode absen
    $mode = "";
    if($mode_absen == 1)
        $mode = "Masuk";
    else if($mode_absen == 2)
        $mode = "Pulang";

    // Baca kartu rfid
    $baca_kartu = mysqli_query($koneksi, "SELECT * FROM rfid");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    $nokartu = $data_kartu['nokartu'];
?>

<div class="container-fluid">
    <?php
        if($nokartu == "") {
    ?>
    <h1>ABSEN : <?php echo $mode ?></h1>
    <img src="../img/rfid.png" alt="">
    <div>SILAHKAN TEMPELKAN KARTU</div>
    
    <?php } else { 
        $cari_siswa = mysqli_query($koneksi, "SELECT * FROM db_siswa WHERE nokartu = '$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_siswa);

        // Cek apakah ada siswa
        if($jumlah_data == 0) {
            echo "<h1>KARTU TIDAK TERDAFTAR</h1>";
        } else {
            // Ambil data siswa
            $data_siswa = mysqli_fetch_array($cari_siswa);
            $nama = $data_siswa['nama'];
            echo "<h1>SELAMAT DATANG $nama</h1>";

            // Tanggal dan jam hari ini
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            // Cek apakah siswa sudah absen
            $cari_absen = mysqli_query($koneksi, "SELECT * FROM rekapitulasi WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
            $jumlah_absen = mysqli_num_rows($cari_absen);
            if($jumlah_absen == 0) {
                echo "<h1>SELAMAT DATANG <br> $nama</h1>";
                mysqli_query($koneksi, "INSERT INTO rekapitulasi (nokartu, tanggal, masuk) VALUES ('$nokartu', '$tanggal', '$jam')");
            } else {
                // Update sesuai pilihan mode
                if($mode_absen == 2) {
                    echo "<h1>SELAMAT PULANG <br> $nama</h1>";
                    mysqli_query($koneksi, "UPDATE rekapitulasi SET masuk = '$jam' WHERE nokartu = '$nokartu' AND tanggal = '$tanggal'");
                }
            }
                
        }

        // Reset kartu
        mysqli_query($koneksi, "DELETE FROM rfid");
    }?>
</div>

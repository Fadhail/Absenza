<?php
include "koneksi.php";

if(isset($_POST['btnUpdate'])) {
    $id = $_POST['id'];
    $nokartu = $_POST['nokartu'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $update = mysqli_query($koneksi, "UPDATE db_siswa SET nokartu = '$nokartu', nisn = '$nisn', nama = '$nama', kelas = '$kelas' WHERE id = $id");

    if($update) {
        echo "<script>alert('Data siswa berhasil diupdate');window.location.replace('siswa.php');</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data siswa');</script>";
    }
}
?>

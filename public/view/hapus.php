<?php
include "koneksi.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = mysqli_query($koneksi, "DELETE FROM db_siswa WHERE id = $id");

    if($hapus) {
        echo "<script>alert('Data siswa berhasil dihapus');window.location.replace('siswa.php');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data siswa');</script>";
    }
}
?>

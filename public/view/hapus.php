<?php
include "koneksi.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, retrieve the nokartu of the student to be deleted
    $query_nokartu = mysqli_query($koneksi, "SELECT nokartu FROM db_siswa WHERE id = $id");
    $row = mysqli_fetch_assoc($query_nokartu);
    $nokartu = $row['nokartu'];

    // Now, delete the related records in the rekapitulasi table
    $hapus_rekapitulasi = mysqli_query($koneksi, "DELETE FROM rekapitulasi WHERE nokartu = '$nokartu'");

    // If the related records in the rekapitulasi table are successfully deleted, proceed to delete the student record
    if($hapus_rekapitulasi) {
        $hapus_siswa = mysqli_query($koneksi, "DELETE FROM db_siswa WHERE id = $id");

        if($hapus_siswa) {
            echo "<script>alert('Data siswa berhasil dihapus');window.location.replace('siswa.php');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data siswa');</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus data siswa');</script>";
    }
}
?>

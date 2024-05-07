<?php
    include "koneksi\koneksi_DB.php";
    if(isset($_POST['btnSimpan'])) 
    {
        $nokartu = $_POST['nokartu'];
        $nisn    = $_POST['nisn'];
        $nama    = $_POST['nama'];
        $kelas   = $_POST['kelas'];
        $simpan  = mysqli_query($koneksi, "insert into db_siswa(nokartu, nisn, nama, kelas)values('$nokartu', '$nisn', '$nama', '$kelas')");

        if($simpan)
        {
            echo "
                alert('Tersimpan');
                location.replace('siswa.php');
            ";
        }
        else
        {
            echo "
                <script>
                    alert('Gagal Tersimpan');
                    location.replace('siswa.php');
                </script>
            ";  
        }

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
</head>
<body>
    <div>
        <h3>Tambah Data Siswa</h3>
        <form method="POST">
            <div>
                <label>No.Kartu</label>
                <input type="text" name="nokartu" id="nokartu" placeholder="Nomor Kartu RFID" class="form-control">
            </div>
            <div>
                <label>NISN</label>
                <input type="text" name="nisn" id="nisn" placeholder="NISN" class="form-control">
            </div>
            <div>
                <label>Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Siswa" class="form-control">
            </div>
            <div>
                <label>Kelas</label>
                <input type="text" name="Kelas" id="kelas" placeholder="Kelas" class="form-control">
            </div>
            <button name="btnSimpan" id="btnSimpan">Simpan</button>
        </form>
    </div>
</body>
</html>
   
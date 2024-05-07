<?php
include "koneksi.php";

if(isset($_POST['btnSimpan'])) {
    $nokartu = $_POST['nokartu'];
    $nisn    = $_POST['nisn'];
    $nama    = $_POST['nama'];
    $kelas   = $_POST['kelas'];

    $stmt = $koneksi->prepare("INSERT INTO db_siswa (nokartu, nisn, nama, kelas) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nokartu, $nisn, $nama, $kelas);
    $result = $stmt->execute();
    
    if($result) {
        echo "<script>alert('Data siswa berhasil disimpan');window.location.replace('siswa.php');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data siswa');</script>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="js\jquery.js"></script>

    <!-- pembacaan rfid otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#norfid").load('nokartu.php')
            },0 );
        });
    </script>

</head>
<body>
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'?>

    <!-- Content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Form -->
            <h3><b>Tambah Data Siswa</b></h3>
            <form method="POST">
                <div id="norfid"></div>
                <div>
                    <label class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white">NISN</label>
                    <input type="text" name="nisn" id="nisn" placeholder="NISN" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <div>
                    <label class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Siswa" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <div>
                    <label class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <input type="text" name="kelas" id="kelas" placeholder="Kelas" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <button type="submit" name="btnSimpan" id="btnSimpan" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'?>

    <!-- Content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <table>
                <tr>
                    <th>Id</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            <tbody>
                <?php
                    include "koneksi\koneksi_DB.php";  
                    $sql = mysqli_query($koneksi, "select * from db_siswa");
                    $id = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $id++; 
                ?>
                <tr>
                    <td> <?php echo $id; ?> </td>
                    <td> <?php echo $data['nokartu']; ?> </td>
                    <td> <?php echo $data['nisn']; ?> </td>
                    <td> <?php echo $data['nama']; ?> </td>
                    <td> <?php echo $data['kelas']; ?> </td>
                    <td>
                        <a href="edit.php>id=<?php echo $data['id']; ?>">Edit | <a href="hapus.php>id=<?php echo $data['id']; ?>">Hapus</a></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
            <a href="tambah.php"> <button>Tambah Data Siswa</button></a>
        </div>
    </div>
</body>
</html>
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

    <!-- Tambah Siswa -->
    <div class="my-8">
        <a href="tambah.php" class="btn ml-2 px-4 py-2 font-medium text-white bg-green-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">[+] Tambah Siswa</a>
    </div>


    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    NO KARTU
                </th>
                <th scope="col" class="px-6 py-3">
                    NISN
                </th>
                <th scope="col" class="px-6 py-3">
                    NAMA
                </th>
                <th scope="col" class="px-6 py-3">
                    KELAS
                </th>
                <th scope="col" class="px-6 py-3">
                    ACTION
                </th>
            </tr>
        </thead>
                <?php
                    include "koneksi.php";  
                    $sql = mysqli_query($koneksi, "select * from db_siswa");
                    $id = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $id++; 
                ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo $data['nokartu']; ?> 
                </th>
                <td class="px-6 py-4">
                    <?php echo $data['nisn']; ?> 
                </td>
                <td class="px-6 py-4">
                    <?php echo $data['nama']; ?> 
                </td>
                <td class="px-6 py-4">
                    <?php echo $data['kelas']; ?>
                </td>
                <td class="px-6 py-4">
                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit | 
                    <a href="hapus.php?id=<?php echo $data['id']; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</a></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
</body>
</html>
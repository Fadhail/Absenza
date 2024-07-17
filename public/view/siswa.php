<?php
include "koneksi.php";

// Mengambil data siswa dari database
$sql = $koneksi->prepare("SELECT * FROM db_siswa");
$sql->execute();
$result = $sql->get_result();
?>

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

    <!-- Filter by Class Form -->
    <form method="get" class="flex items-center mb-6">
        <label for="kelas" class="text-sm font-medium mr-2">Pilih Kelas :</label>
        <select name="kelas" id="kelas" class="rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Semua Kelas</option>
            <?php
                include "koneksi.php";
                $kelas_query = mysqli_query($koneksi, "SELECT DISTINCT kelas FROM db_siswa ORDER BY kelas");
                while ($kelas_data = mysqli_fetch_assoc($kelas_query)) {
                    $selected = isset($_GET['kelas']) && $_GET['kelas'] == $kelas_data['kelas'] ? 'selected' : '';
                    echo "<option value='{$kelas_data['kelas']}' $selected>{$kelas_data['kelas']}</option>";
                }
            ?>
        </select>
        <button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-center text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 ml-2">
            Filter
        </button>
    </form>

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
            <?php while($data = $result->fetch_assoc()) { ?>
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
                            <a href="edit.php?id=<?php echo $data['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> | 
                            <a href="hapus.php?id=<?php echo $data['id']; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
</body>
</html>
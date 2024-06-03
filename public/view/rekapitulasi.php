<?php
include 'koneksi.php';

// Validasi tanggal
if (isset($_GET['tanggal'])) {
    $tanggal = date('Y-m-d', strtotime($_GET['tanggal']));
} else {
    $tanggal = date('Y-m-d');
}

// Filter absensi berdasarkan tanggal
$sql = $koneksi->prepare("SELECT b.nokartu, b.nama, a.tanggal, a.jam_masuk, a.jam_pulang FROM rekapitulasi a INNER JOIN db_siswa b ON a.nokartu = b.nokartu WHERE a.tanggal = ?");
$sql->bind_param("s", $tanggal);
$sql->execute();
$result = $sql->get_result();

$no = 0;
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
    <?php include 'components/sidebar.php'; ?>

    <!-- Content -->
    <div class="p-4 sm:ml-64">

    <!-- Pilih Tanggal -->
    <?php

// Check if a date is submitted
if (isset($_GET['tanggal'])) {
  $selectedDate = $_GET['tanggal'];
} else {
  $selectedDate = ""; // Default value if no date selected
}

?>

<form method="get" class="flex items-center">
  <label for="tanggal" class="text-sm font-medium mr-2">Pilih Tanggal :</label>
  <input type="date" name="tanggal" id="tanggal" value="<?php echo $selectedDate; ?>" class="rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
  <button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-center text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 ml-2">Filter</button>
</form>

    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    NO
                </th>
                <th scope="col" class="px-6 py-3">
                    NO KARTU
                </th>
                <th scope="col" class="px-6 py-3">
                    NAMA
                </th>
                <th scope="col" class="px-6 py-3">
                    TANGGAL
                </th>
                <th scope="col" class="px-6 py-3">
                    JAM MASUK
                </th>
                <th scope="col" class="px-6 py-3">
                    JAM PULANG
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = $result->fetch_assoc()) {
                $no++;
            ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $no; ?>
                    </th>
                    <td class="px-6 py-4">
                        <?php echo isset($data['nokartu']) ? $data['nokartu'] : ''; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo isset($data['nama']) ? $data['nama'] : ''; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo isset($data['tanggal']) ? $data['tanggal'] : ''; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo isset($data['jam_masuk']) ? $data['jam_masuk'] : ''; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo isset($data['jam_pulang']) ? $data['jam_pulang'] : ''; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
</body>
</html>

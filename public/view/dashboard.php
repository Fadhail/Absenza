<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'?>

    <!-- Content -->
    <div class="p-4 sm:ml-64">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-6 text-center">
                    <?php
                        include "koneksi.php";
                        $count_query = mysqli_query($koneksi, "SELECT COUNT(*) as total_siswa FROM db_siswa");
                        $count_result = mysqli_fetch_assoc($count_query);
                        $total_siswa = $count_result['total_siswa'];
                    ?>
                    <h2 class="text-3xl font-semibold text-gray-800"><?php echo $total_siswa; ?></h2>
                    <p class="text-gray-600 mt-2">Siswa</p>
                    <a href="siswa.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: Total Rekapitulasi -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-6 text-center">
                    <?php
                        include "koneksi.php";

                        // Check if a date is selected
                        if (isset($_GET['rekap_date'])) {
                            $selected_date = $_GET['rekap_date'];
                        } else {
                            // Fetch the most recent date of rekapitulasi if no date is selected
                            $date_query = mysqli_query($koneksi, "SELECT MAX(tanggal) as latest_date FROM rekapitulasi");
                            $date_result = mysqli_fetch_assoc($date_query);
                            $selected_date = $date_result['latest_date'];
                        }

                        // Fetch total count of rekapitulasi for the selected date
                        $count_query = mysqli_query($koneksi, "SELECT COUNT(*) as total_rekapitulasi FROM rekapitulasi WHERE tanggal = '$selected_date'");
                        $count_result = mysqli_fetch_assoc($count_query);
                        $total_rekapitulasi = $count_result['total_rekapitulasi'];
                    ?>
                    <h2 class="text-3xl font-semibold text-gray-800"><?php echo $total_rekapitulasi; ?></h2>
                    <p class="text-gray-600 mt-2">Rekapitulasi</p>
                    
                    <!-- Date Picker Form -->
                    <form method="get" class="mt-4">
                        <input type="date" name="rekap_date" value="<?php echo $selected_date; ?>" class="rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="rounded-md bg-indigo-600 py-2 px-4 text-center text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 ml-2">
                            Filter
                        </button>
                    </form>

                    <a href="rekapitulasi.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">
                        Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>


            <!-- Card 3: Jumlah Kelas -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-6 text-center">
                    <?php
                        include "koneksi.php";
                        // Query untuk menghitung jumlah kelas yang unik
                        $kelas_query = mysqli_query($koneksi, "SELECT COUNT(DISTINCT kelas) as jumlah_kelas FROM db_siswa");
                        $kelas_data = mysqli_fetch_assoc($kelas_query);
                        $jumlah_kelas = $kelas_data['jumlah_kelas'];
                    ?>
                    <h2 class="text-3xl font-semibold text-gray-800"><?php echo $jumlah_kelas; ?></h2>
                    <p class="text-gray-600 mt-2">Jumlah Kelas</p>
                    <a href="kelas.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">
                        Lihat Detail
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>

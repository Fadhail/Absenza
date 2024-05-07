<?php
include "koneksi.php";

// baca isi tabel
$sql = mysqli_query($koneksi, "SELECT * FROM rfid");
if ($sql) {
    $data = mysqli_fetch_array($sql);
    // baca no kartu
    $nokartu = isset($data['nokartu']) ? $data['nokartu'] : '';
} else {
    // Handle kesalahan SQL
    $nokartu = 'Tidak';
}
?>

<div>
    <label for="nokartu" class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.Kartu</label>
    <input type="text" name="nokartu" id="nokartu" value="<?php echo $nokartu; ?>" placeholder="Nomor Kartu RFID" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
</div>

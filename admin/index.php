<?php
// Tentukan judul halaman
$page_title = 'Dashboard Admin';

// Panggil kerangka utama (header dan sidebar)
require_once('../includes/header.php');
require_once('../config/database.php');

// --- Logika untuk Mengambil Data Ringkasan ---

// Menghitung total pengguna (Admin dan Petugas)
$sql_users = "SELECT COUNT(id) AS total_pengguna FROM users";
$result_users = mysqli_query($koneksi, $sql_users);
$total_pengguna = mysqli_fetch_assoc($result_users)['total_pengguna'];

// Menghitung total pohon yang terdaftar
$sql_trees = "SELECT COUNT(id) AS total_pohon FROM trees";
$result_trees = mysqli_query($koneksi, $sql_trees);
$total_pohon = mysqli_fetch_assoc($result_trees)['total_pohon'];

// Menghitung total laporan yang sudah masuk
$sql_reports = "SELECT COUNT(id) AS total_laporan FROM reports";
$result_reports = mysqli_query($koneksi, $sql_reports);
$total_laporan = mysqli_fetch_assoc($result_reports)['total_laporan'];
?>

<div class="card">
    <h2 class="card-title">Ringkasan Sistem</h2>
    <div class="iot-grid">
        <div class="iot-card">
            <p class="iot-label">Total Pengguna</p>
            <p class="iot-value text-blue"><?php echo $total_pengguna; ?></p>
            <p class="iot-status status-optimal">Aktif</p>
        </div>

        <div class="iot-card">
            <p class="iot-label">Total Pohon</p>
            <p class="iot-value text-green"><?php echo $total_pohon; ?></p>
            <p class="iot-status status-normal">Termonitor</p>
        </div>

        <div class="iot-card">
            <p class="iot-label">Total Laporan</p>
            <p class="iot-value text-yellow"><?php echo $total_laporan; ?></p>
            <p class="iot-status status-baik">Tercatat</p>
        </div>
    </div>
</div>

<div class="card">
    <h2 class="card-title">Selamat Datang, <?php echo htmlspecialchars($_SESSION['user_nama']); ?>!</h2>
    <p>Anda login sebagai **Admin**. Dari panel ini, Anda dapat mengelola data pengguna dan data pohon dalam sistem.</p>
    <p style="margin-top: 1rem;">Silakan gunakan menu di sebelah kiri untuk memulai.</p>
</div>


<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
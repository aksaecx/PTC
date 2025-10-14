<?php
// Panggil file koneksi database terlebih dahulu
require_once('../config/database.php');

// --- Logika untuk Mengambil Data ---

// Ambil ID pohon dari URL (?id=...)
// intval() digunakan untuk memastikan kita hanya menerima angka (keamanan)
$tree_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Jika tidak ada ID, redirect kembali ke dasbor
if ($tree_id <= 0) {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil detail pohon spesifik
$sql_tree = "SELECT * FROM trees WHERE id = $tree_id";
$result_tree = mysqli_query($koneksi, $sql_tree);

// Cek apakah pohon ditemukan
if (mysqli_num_rows($result_tree) == 0) {
    // Jika tidak ditemukan, tampilkan pesan error
    $page_title = 'Error';
    include('../includes/header.php');
    echo "<div class='card'><p class='text-center'>Pohon tidak ditemukan.</p></div>";
    include('../includes/footer.php');
    exit();
}

// Ambil data pohon ke dalam variabel array
$pohon = mysqli_fetch_assoc($result_tree);

// Set judul halaman setelah mendapatkan nama pohon
$page_title = 'Detail: ' . htmlspecialchars($pohon['nama_umum']);
include('../includes/header.php');

// Query untuk mengambil semua riwayat laporan untuk pohon ini, diurutkan dari yang terbaru
// Kita menggunakan JOIN untuk mendapatkan nama petugas dari tabel 'users'
$sql_reports = "SELECT reports.*, users.nama AS nama_petugas 
                FROM reports 
                JOIN users ON reports.id_petugas = users.id 
                WHERE reports.id_pohon = $tree_id 
                ORDER BY tanggal_lapor DESC";
$result_reports = mysqli_query($koneksi, $sql_reports);
?>

<div class="card">
    <div class="flex items-center gap-4">
        <div class="text-6xl"><?php echo htmlspecialchars($pohon['emoji']); ?></div>
        <div>
            <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($pohon['nama_umum']); ?></h1>
            <p class="text-md text-gray-500 italic"><?php echo htmlspecialchars($pohon['nama_ilmiah']); ?></p>
        </div>
    </div>
    <div class="mt-4 border-t pt-4">
        <h3 class="font-semibold mb-2">Deskripsi</h3>
        <p class="text-gray-700"><?php echo htmlspecialchars($pohon['deskripsi']); ?></p>
    </div>
</div>

<div class="card">
    <h2 class="card-title">Riwayat Laporan Perawatan</h2>
    <div class="log-history-container">
        <?php
        if (mysqli_num_rows($result_reports) > 0) {
            // Looping untuk menampilkan setiap laporan
            while($laporan = mysqli_fetch_assoc($result_reports)) {
        ?>
            <div class="log-item">
                <div class="log-header">
                    <span class="log-type"><?php echo htmlspecialchars($laporan['jenis_tindakan']); ?></span>
                    <span class="log-date"><?php echo date('d M Y, H:i', strtotime($laporan['tanggal_lapor'])); ?></span>
                </div>
                <div class="log-body">
                    <p><?php echo htmlspecialchars($laporan['catatan']); ?></p>
                </div>
                <div class="log-footer">
                    <span>Oleh: <?php echo htmlspecialchars($laporan['nama_petugas']); ?></span>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='text-center text-gray-500'>Belum ada riwayat laporan untuk pohon ini.</p>";
        }
        ?>
    </div>
</div>

<div class="text-center">
    <a href="report_form.php?tree_id=<?php echo $tree_id; ?>" class="btn-primary-action">📝 Buat Catatan Baru</a>
</div>


<?php
// Panggil file footer untuk menutup halaman
include('../includes/footer.php');
?>
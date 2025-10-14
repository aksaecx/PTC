<?php
// Panggil file koneksi database
require_once('../config/database.php');

// Ambil ID pohon dari URL
$tree_id = isset($_GET['tree_id']) ? intval($_GET['tree_id']) : 0;

// Jika tidak ada ID, kembali ke dasbor
if ($tree_id <= 0) {
    header("Location: index.php");
    exit();
}

// Ambil nama pohon untuk ditampilkan di judul
$sql_tree = "SELECT nama_umum FROM trees WHERE id = $tree_id";
$result_tree = mysqli_query($koneksi, $sql_tree);
$pohon = mysqli_fetch_assoc($result_tree);
$nama_pohon = $pohon ? $pohon['nama_umum'] : 'Tidak Dikenal';

// Set judul halaman
$page_title = 'Catat Tindakan: ' . htmlspecialchars($nama_pohon);
include('../includes/header.php');
?>

<div class="card">
    <h2 class="card-title">Form Pencatatan Tindakan</h2>
    <p class="mb-4 text-gray-600">Anda sedang membuat laporan untuk pohon: <strong><?php echo htmlspecialchars($nama_pohon); ?></strong></p>

    <form action="save_report.php" method="POST">
        <input type="hidden" name="id_pohon" value="<?php echo $tree_id; ?>">

        <div class="form-group">
            <label for="jenis_tindakan">Jenis Tindakan</label>
            <select id="jenis_tindakan" name="jenis_tindakan" class="form-input" required>
                <option value="">-- Pilih Jenis Tindakan --</option>
                <option value="Penyiraman">Penyiraman</option>
                <option value="Pemupukan">Pemupukan</option>
                <option value="Pemangkasan">Pemangkasan</option>
                <option value="Pengendalian Hama">Pengendalian Hama</option>
                <option value="Pemeriksaan Rutin">Pemeriksaan Rutin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="catatan">Catatan Observasi</label>
            <textarea id="catatan" name="catatan" rows="5" class="form-input" placeholder="Tuliskan hasil observasi Anda di sini..."></textarea>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="btn-primary-action">💾 Simpan Laporan</button>
            <a href="tree_detail.php?id=<?php echo $tree_id; ?>" class="btn-secondary-action">Batal</a>
        </div>
    </form>
</div>

<?php
// Panggil footer
include('../includes/footer.php');
?>
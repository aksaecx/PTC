<?php
// Tentukan judul halaman
$page_title = 'Edit Data Pohon';

require_once('../includes/header.php');
require_once('../config/database.php');

// 1. Ambil ID pohon dari URL
$tree_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($tree_id <= 0) {
    header("Location: manage_trees.php?error=ID pohon tidak valid.");
    exit();
}

// 2. Ambil data pohon saat ini dari database
$sql = "SELECT * FROM trees WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $tree_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$pohon = mysqli_fetch_assoc($result);

// Jika pohon tidak ditemukan, kembali ke halaman manajemen
if (!$pohon) {
    header("Location: manage_trees.php?error=Data pohon tidak ditemukan.");
    exit();
}
?>

<div class="card">
    <h2 class="card-title">Formulir Edit Pohon</h2>
    <p class="mb-4 text-gray-600">Anda sedang mengedit data untuk: <strong><?php echo htmlspecialchars($pohon['nama_umum']); ?></strong></p>

    <form action="process_edit_tree.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $tree_id; ?>">

        <div class="form-group">
            <label for="id_pohon_unik">ID Unik Pohon</label>
            <input type="text" id="id_pohon_unik" name="id_pohon_unik" class="form-input" value="<?php echo htmlspecialchars($pohon['id_pohon_unik']); ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_umum">Nama Umum</label>
            <input type="text" id="nama_umum" name="nama_umum" class="form-input" value="<?php echo htmlspecialchars($pohon['nama_umum']); ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_ilmiah">Nama Ilmiah</label>
            <input type="text" id="nama_ilmiah" name="nama_ilmiah" class="form-input" value="<?php echo htmlspecialchars($pohon['nama_ilmiah']); ?>">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Singkat</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="form-input"><?php echo htmlspecialchars($pohon['deskripsi']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="emoji">Emoji (Opsional)</label>
            <input type="text" id="emoji" name="emoji" class="form-input" value="<?php echo htmlspecialchars($pohon['emoji']); ?>">
        </div>

        <div class="mt-6">
            <button type="submit" class="btn-primary-action" style="background-color: #388E3C;">💾 Simpan Perubahan</button>
            <a href="manage_trees.php" class="btn-secondary-action">Batal</a>
        </div>
    </form>
</div>

<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
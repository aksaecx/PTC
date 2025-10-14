<?php
// Tentukan judul halaman
$page_title = 'Edit Pengguna';

require_once('../includes/header.php');
require_once('../config/database.php');

// 1. Ambil ID pengguna dari URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id <= 0) {
    header("Location: manage_users.php?error=ID pengguna tidak valid.");
    exit();
}

// 2. Ambil data pengguna saat ini dari database
$sql = "SELECT nama, username, peran FROM users WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Jika pengguna tidak ditemukan, kembali ke halaman manajemen
if (!$user) {
    header("Location: manage_users.php?error=Pengguna tidak ditemukan.");
    exit();
}
?>

<div class="card">
    <h2 class="card-title">Formulir Edit Pengguna</h2>
    <p class="mb-4 text-gray-600">Anda sedang mengedit data untuk: <strong><?php echo htmlspecialchars($user['nama']); ?></strong></p>

    <form action="process_edit_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-input" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-input" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password Baru (Opsional)</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Isi hanya jika ingin mengubah password">
        </div>

        <div class="form-group">
            <label for="peran">Peran (Role)</label>
            <select id="peran" name="peran" class="form-input" required>
                <option value="Petugas" <?php if($user['peran'] == 'Petugas') echo 'selected'; ?>>Petugas</option>
                <option value="Admin" <?php if($user['peran'] == 'Admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="btn-primary-action" style="background-color: #388E3C;">💾 Simpan Perubahan</button>
            <a href="manage_users.php" class="btn-secondary-action">Batal</a>
        </div>
    </form>
</div>

<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
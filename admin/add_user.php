<?php
// Tentukan judul halaman
$page_title = 'Tambah Pengguna Baru';

// Panggil kerangka utama
require_once('../includes/header.php');
?>

<div class="card">
    <h2 class="card-title">Formulir Tambah Pengguna</h2>
    <p class="mb-4 text-gray-600">Isi detail pengguna baru di bawah ini.</p>

    <form action="process_add_user.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="peran">Peran (Role)</label>
            <select id="peran" name="peran" class="form-input" required>
                <option value="Petugas">Petugas</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="btn-primary-action" style="background-color: #388E3C;">💾 Simpan Pengguna</button>
            <a href="manage_users.php" class="btn-secondary-action">Batal</a>
        </div>
    </form>
</div>

<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
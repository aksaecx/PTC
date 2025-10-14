<?php
// Tentukan judul halaman
$page_title = 'Tambah Pohon Baru';

// Panggil kerangka utama
require_once('../includes/header.php');
?>

<div class="card">
    <h2 class="card-title">Formulir Tambah Pohon</h2>
    <p class="mb-4 text-gray-600">Isi detail pohon baru di bawah ini.</p>

    <form action="process_add_tree.php" method="POST">
        <div class="form-group">
            <label for="id_pohon_unik">ID Unik Pohon (Contoh: KRJ-004)</label>
            <input type="text" id="id_pohon_unik" name="id_pohon_unik" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="nama_umum">Nama Umum</label>
            <input type="text" id="nama_umum" name="nama_umum" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="nama_ilmiah">Nama Ilmiah</label>
            <input type="text" id="nama_ilmiah" name="nama_ilmiah" class="form-input">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Singkat</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="form-input"></textarea>
        </div>

        <div class="form-group">
            <label for="emoji">Emoji (Opsional)</label>
            <input type="text" id="emoji" name="emoji" class="form-input" placeholder="🌳">
        </div>

        <div class="mt-6">
            <button type="submit" class="btn-primary-action" style="background-color: #388E3C;">💾 Simpan Pohon</button>
            <a href="manage_trees.php" class="btn-secondary-action">Batal</a>
        </div>
    </form>
</div>

<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
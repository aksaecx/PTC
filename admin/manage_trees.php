<?php
// Tentukan judul halaman
$page_title = 'Manajemen Pohon';

// Panggil kerangka utama
require_once('../includes/header.php');
require_once('../config/database.php');
?>

<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="card-title" style="margin-bottom: 0;">Daftar Pohon Terdaftar</h2>
        <a href="add_tree.php" class="btn-primary-action" style="background-color: #388E3C;">➕ Tambah Pohon</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Unik</th>
                    <th>Nama Umum</th>
                    <th>Nama Ilmiah</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil semua data pohon dari database
                $sql = "SELECT id, id_pohon_unik, nama_umum, nama_ilmiah, deskripsi FROM trees ORDER BY id ASC";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Looping untuk menampilkan setiap baris data pohon
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_pohon_unik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_umum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_ilmiah']) . "</td>";
                        // Memotong deskripsi agar tidak terlalu panjang di tabel
                        echo "<td>" . substr(htmlspecialchars($row['deskripsi']), 0, 50) . "...</td>";
                        
                        // Tombol aksi (saat ini belum berfungsi)
                        echo "<td class='text-center'>";
                        echo "<a href='edit_tree.php?id=" . $row['id'] . "' class='action-link-edit'>Edit</a> ";
                        echo "<a href='delete_tree.php?id=" . $row['id'] . "' class='action-link-delete' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data pohon ini?');\">Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data pohon yang terdaftar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
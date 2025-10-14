<?php
// Tentukan judul halaman
$page_title = 'Manajemen Pengguna';

// Panggil kerangka utama
require_once('../includes/header.php');
require_once('../config/database.php');
?>

<div class="card">
    <?php
    // Cek apakah ada pesan notifikasi di session
    if (isset($_SESSION['message'])) {
        // Tentukan warna notifikasi berdasarkan tipenya
        $message_type_class = $_SESSION['message_type'] == 'success' ? 'alert-success' : 'alert-error';
        
        // Tampilkan pesan notifikasi
        echo "<div class='alert " . $message_type_class . "'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        
        // Hapus pesan dari session agar tidak tampil lagi saat halaman di-refresh
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>
    <div class="flex justify-between items-center mb-4">
        <h2 class="card-title" style="margin-bottom: 0;">Daftar Pengguna Sistem</h2>
        <a href="add_user.php" class="btn-primary-action" style="background-color: #388E3C;">➕ Tambah Pengguna</a>
    </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Peran</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil semua data pengguna dari database
                $sql = "SELECT id, nama, username, peran FROM users ORDER BY id ASC";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Looping untuk menampilkan setiap baris data pengguna
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        
                        // Memberi gaya pada label peran
                        if ($row['peran'] == 'Admin') {
                            echo "<td><span class='role-admin'>" . $row['peran'] . "</span></td>";
                        } else {
                            echo "<td><span class='role-petugas'>" . $row['peran'] . "</span></td>";
                        }

                        // Tombol aksi (saat ini belum berfungsi)
                        echo "<td class='text-center'>";
                        echo "<a href='edit_user.php?id=" . $row['id'] . "' class='action-link-edit'>Edit</a> ";
                        echo "<a href='delete_user.php?id=" . $row['id'] . "' class='action-link-delete' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');\">Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data pengguna.</td></tr>";
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
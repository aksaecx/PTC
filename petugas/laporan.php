<?php
// Tentukan judul halaman
$page_title = 'Laporan Saya';

// Panggil kerangka utama
include('../includes/header.php');
require_once('../config/database.php');

// Ambil ID petugas yang sedang login dari session
$id_petugas_login = $_SESSION['user_id'];
?>

<div class="card">
    <h2 class="card-title">Riwayat Laporan Saya</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pohon</th>
                    <th>Jenis Tindakan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil laporan HANYA dari petugas yang login
                // Kita JOIN dengan tabel 'trees' untuk mendapatkan nama pohonnya
                $sql = "SELECT r.tanggal_lapor, r.jenis_tindakan, r.catatan, t.nama_umum
                        FROM reports r
                        JOIN trees t ON r.id_pohon = t.id
                        WHERE r.id_petugas = $id_petugas_login
                        ORDER BY r.tanggal_lapor DESC";

                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        // Ubah format tanggal agar lebih mudah dibaca
                        echo "<td>" . date('d M Y H:i', strtotime($row['tanggal_lapor'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_umum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_tindakan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['catatan']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Anda belum membuat laporan apapun.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Panggil penutup halaman
include('../includes/footer.php');
?>
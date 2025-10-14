<?php
// Tentukan judul halaman
$page_title = 'Daftar Pohon';

// Panggil kerangka utama
include('../includes/header.php');
require_once('../config/database.php');
?>

<div class="card">
    <h2 class="card-title">Daftar Semua Pohon Terlindungi</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Pohon</th>
                    <th>Nama Umum</th>
                    <th>Nama Ilmiah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ini sama seperti di dasbor, mengambil semua pohon
                $sql = "SELECT id, id_pohon_unik, nama_umum, nama_ilmiah FROM trees ORDER BY id_pohon_unik ASC";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_pohon_unik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_umum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_ilmiah']) . "</td>";
                        echo "<td><a href='tree_detail.php?id=" . $row['id'] . "' class='action-link'>Detail & Riwayat</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Tidak ada data pohon.</td></tr>";
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
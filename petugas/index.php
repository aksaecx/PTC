<?php
// Tentukan judul halaman untuk ditampilkan di header
$page_title = 'Dashboard Petugas';

// Panggil kerangka utama (header dan sidebar)
// Path ../ artinya "naik satu level direktori" untuk menemukan folder includes
require_once('../includes/header.php');

// Panggil file koneksi database untuk mengambil data
require_once('../config/database.php');
?>

<div class="card">
    <h2 class="card-title">Ringkasan Lingkungan (Data IoT)</h2>
    <div class="iot-grid">
        <div class="iot-card">
            <p class="iot-label">Kelembapan Udara</p>
            <p class="iot-value text-blue">75%</p>
            <p class="iot-status status-normal">Normal</p>
        </div>
        <div class="iot-card">
            <p class="iot-label">Suhu Udara</p>
            <p class="iot-value text-red">29.2°C</p>
            <p class="iot-status status-optimal">Optimal</p>
        </div>
        <div class="iot-card">
            <p class="iot-label">Kelembapan Tanah</p>
            <p class="iot-value text-yellow">68%</p>
            <p class="iot-status status-baik">Baik</p>
        </div>
    </div>
</div>

<div class="card">
    <h2 class="card-title">Daftar Pohon Terlindungi</h2>
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
                // Query untuk mengambil semua data pohon dari database
                $sql = "SELECT id, id_pohon_unik, nama_umum, nama_ilmiah FROM trees ORDER BY id_pohon_unik ASC";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Looping untuk menampilkan setiap baris data pohon
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_pohon_unik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_umum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_ilmiah']) . "</td>";
                        // Link ke halaman detail, mengirimkan id pohon melalui URL
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
// Panggil kerangka penutup
require_once('../includes/footer.php');
?>
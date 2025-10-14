<?php
session_start();
require_once('../config/database.php');

// Keamanan: Pastikan hanya Admin yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['user_peran'] != 'Admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $id_pohon_unik = mysqli_real_escape_string($koneksi, $_POST['id_pohon_unik']);
    $nama_umum = mysqli_real_escape_string($koneksi, $_POST['nama_umum']);
    $nama_ilmiah = mysqli_real_escape_string($koneksi, $_POST['nama_ilmiah']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $emoji = mysqli_real_escape_string($koneksi, $_POST['emoji']);

    // Validasi data penting tidak boleh kosong
    if (empty($id_pohon_unik) || empty($nama_umum)) {
        header("Location: manage_trees.php?error=ID Unik dan Nama Umum harus diisi!");
        exit();
    }
    
    // Cek apakah ID Unik sudah ada
    $sql_check = "SELECT id FROM trees WHERE id_pohon_unik = ?";
    $stmt_check = mysqli_prepare($koneksi, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $id_pohon_unik);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        header("Location: manage_trees.php?error=ID Pohon '" . htmlspecialchars($id_pohon_unik) . "' sudah terdaftar.");
        exit();
    }
    
    // Siapkan query SQL untuk menyimpan pohon baru
    $sql_insert = "INSERT INTO trees (id_pohon_unik, nama_umum, nama_ilmiah, deskripsi, emoji) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "sssss", $id_pohon_unik, $nama_umum, $nama_ilmiah, $deskripsi, $emoji);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt_insert)) {
        header("Location: manage_trees.php?success=Pohon baru berhasil ditambahkan!");
        exit();
    } else {
        header("Location: manage_trees.php?error=Gagal menyimpan data ke database.");
        exit();
    }

} else {
    // Jika file diakses langsung
    header("Location: index.php");
    exit();
}
?>
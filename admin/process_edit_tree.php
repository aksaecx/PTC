<?php
session_start();
require_once('../config/database.php');

// Keamanan: Pastikan hanya Admin yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['user_peran'] != 'Admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form
    $id = intval($_POST['id']);
    $id_pohon_unik = mysqli_real_escape_string($koneksi, $_POST['id_pohon_unik']);
    $nama_umum = mysqli_real_escape_string($koneksi, $_POST['nama_umum']);
    $nama_ilmiah = mysqli_real_escape_string($koneksi, $_POST['nama_ilmiah']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $emoji = mysqli_real_escape_string($koneksi, $_POST['emoji']);
    
    // Validasi dasar
    if (empty($id) || empty($id_pohon_unik) || empty($nama_umum)) {
        header("Location: manage_trees.php?error=Data tidak lengkap.");
        exit();
    }
    
    // Siapkan query UPDATE menggunakan prepared statement
    $sql = "UPDATE trees SET id_pohon_unik = ?, nama_umum = ?, nama_ilmiah = ?, deskripsi = ?, emoji = ? WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $id_pohon_unik, $nama_umum, $nama_ilmiah, $deskripsi, $emoji, $id);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, kembali ke halaman manajemen dengan pesan sukses
        header("Location: manage_trees.php?success=Data pohon berhasil diperbarui!");
        exit();
    } else {
        // Jika gagal, kembali dengan pesan error
        header("Location: manage_trees.php?error=Gagal memperbarui data: " . mysqli_error($koneksi));
        exit();
    }

} else {
    // Jika file diakses langsung, redirect
    header("Location: index.php");
    exit();
}
?>
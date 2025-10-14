<?php
session_start();
require_once('../config/database.php');

// Pastikan hanya petugas yang login yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['user_peran'] != 'Petugas') {
    header("Location: ../index.php");
    exit();
}

// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form dengan aman
    $id_pohon = intval($_POST['id_pohon']);
    $jenis_tindakan = mysqli_real_escape_string($koneksi, $_POST['jenis_tindakan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
    
    // Ambil ID petugas dari session yang sedang login
    $id_petugas = $_SESSION['user_id'];

    // Validasi dasar (pastikan data penting tidak kosong)
    if (empty($id_pohon) || empty($jenis_tindakan)) {
        // Jika data tidak lengkap, kembalikan ke form dengan pesan error
        header("Location: report_form.php?id_pohon=" . $id_pohon . "&error=Data tidak lengkap");
        exit();
    }
    
    // Siapkan query SQL untuk menyimpan data
    $sql = "INSERT INTO reports (id_pohon, id_petugas, jenis_tindakan, catatan) VALUES ('$id_pohon', '$id_petugas', '$jenis_tindakan', '$catatan')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, redirect kembali ke halaman detail pohon
        header("Location: tree_detail.php?id=" . $id_pohon . "&success=Laporan berhasil disimpan");
        exit();
    } else {
        // Jika gagal, redirect kembali ke form dengan pesan error
        header("Location: report_form.php?id_pohon=" . $id_pohon . "&error=Gagal menyimpan laporan: " . mysqli_error($koneksi));
        exit();
    }

} else {
    // Jika file diakses langsung, redirect ke dasbor
    header("Location: index.php");
    exit();
}
?>
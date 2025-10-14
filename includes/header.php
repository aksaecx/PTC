<?php
session_start();

// Definisikan base URL agar path selalu benar
$base_url = "/monitoring-krj"; // Sesuaikan jika nama folder Anda berbeda

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, tendang kembali ke halaman login utama
    header("Location: " . $base_url . "/index.php");
    exit();
}

$user_role = $_SESSION['user_peran'];
$user_name = $_SESSION['user_nama'];
$user_avatar = strtoupper(substr($user_name, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Monitoring Cerdas KRJ</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css">
    <style>
        /* CSS Tambahan ada di sini jika diperlukan */
    </style>
</head>
<body>
    <div class="main-container">
        <aside class="sidebar">
            <div style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">
                <img src="<?php echo $base_url; ?>/assets/images/krj.png" alt="Logo" style="height: 50px; margin: 0 auto 10px;">
                <h2 style="font-weight: 600; color: #2E7D32;"><?php echo $user_role; ?> Panel</h2>
            </div>
            <nav style="flex: 1; display: flex; flex-direction: column;">
                <?php
                if ($user_role == 'Admin') {
                    include('sidebar_admin.php');
                } else {
                    include('sidebar_petugas.php');
                }
                ?>
                 <a href="<?php echo $base_url; ?>/logout.php" class="menu-item logout">Logout</a>
            </nav>
        </aside>

        <div class="content-wrapper">
            <header class="header">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #333;"><?php echo $page_title; ?></h1>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-weight: 500;"><?php echo $user_name; ?></span>
                    <div class="user-avatar"><?php echo $user_avatar; ?></div>
                </div>
            </header>
            
            <main class="main-content">
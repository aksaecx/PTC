<?php
session_start();
$base_url = "/monitoring-krj"; // Sesuaikan jika nama folder Anda berbeda

// Jika pengguna sudah login, langsung arahkan ke dasbor yang sesuai
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_peran'] == 'Admin') {
        header("Location: " . $base_url . "/admin/index.php");
    } else {
        header("Location: " . $base_url . "/petugas/index.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Monitoring Cerdas KRJ</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <img src="<?php echo $base_url; ?>/assets/images/krj.png" alt="Logo KRJ" class="logo">
            <h1 class="title">MONITORING CERDAS</h1>
            <p class="subtitle">Silakan login untuk melanjutkan</p>

            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Admin/Petugas" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <?php 
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>